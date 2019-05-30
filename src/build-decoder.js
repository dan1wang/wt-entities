/*
 * Tool for building code for decoding named and numeric character references
 *
 * Code according to rule specified by
 * https://html.spec.whatwg.org/multipage/parsing.html#character-reference-state
 */

const fs = require('fs');
const { html5EntitiesSorted } = require('./entities-dict');

let target = 'javascript';
let declare;  // var varName     / varName
let strLen;   // varName.length  / strlen(varName)
let arrayLen; // varName.length  / count(varName)
let splitStr; // varName.split(sep)  / explode(sep, varName)
let charAt;   // varName.charAt(pos) / varName[pos]
let searchStr;  // varName.indexOf(s) / strpos(varName, s)
let searchArray;// varName.indexOf(v) / array_search(v, varName)
let searchArrayFailed = -1;
let searchStrFailed = -1;
let subStr;   // varName.substring(start, end)  / substr(varName, start, end)
let joinStr;  // varName += s1 + s2 ...;        / varName .= s1 . s2 ...;
let ReplacementChar; // '\uFFFD'
function initLanguage(lang) {
  target = lang;

  declare =  (v) => target !== 'php'? `var ${v}`    : v ;

  strLen =   (v) => target !== 'php'? `${v}.length` : `strlen(${v})`;
  arrayLen = (v) => target !== 'php'? `${v}.length` : `count(${v})`;

  splitStr = (v, sep) => target !== 'php' ? `${v}.split(${sep})`: `explode(${sep}, $${v})`;
  charAt =   (v, pos) => target !== 'php' ? `${v}.charAt(${pos})` : `${v}[${pos}]`;

  searchStr = (v, s)   => target !== 'php' ? `${v}.indexOf(${s})`  : `strpos(${v},${s})`;
  searchArray = (v, s) => target !== 'php' ? `${v}.indexOf(${s})` : `array_search(${s},${v})`;

  searchArrayFailed = target == 'php'?'false':'-1';
  searchStrFailed = target == 'php'?'false':'-1';

  subStr = (v, start, end) => {
    return target !== 'php'
      ? (end === undefined ? `${v}.substring(${start})` : `${v}.substring(${start},${end})`)
      : (end === undefined ? `substr(${v},${start})||''` : `substr(${v},${start},${end})||''`);
  };

  joinStr = (varName, ...strings) => {
    let expr ='';
    if (target == 'php') {
      if (varName !== undefined) expr = varName + ' .= ';
      expr += strings.join(' . ');
    } else {
      if (varName !== undefined) expr = varName + ' += ';
      expr += strings.join(' + ');
    }
    return expr;
  };

  ReplacementChar = target !== 'php'?'\\u{FFFD}':'\\uFFFD';
}

function charCode(s) { return s.charCodeAt(0); }

function buildDecoder() {
  const decoderSource =
`function decodeCharReferences($text) {
	if (${strLen('$text')} == 0) return '';
	${declare('$fragments')} = ${splitStr('$text',"'&'")};
	if (${arrayLen('$fragments')} == 1) return $text;

	${declare('$output')} = $fragments[0];
	for (${declare('$i')} = 1; $i < ${arrayLen('$fragments')}; $i++) {
		${declare('$seg')} = $fragments[$i];
		if (${charAt('$seg',0)} == '#') {
			${declare('$cp')} = 0;
			${declare('$isEmpty')} = false;
			${declare('$j')} = 1;
			%%NumericCRParser%%
			if ( ($isEmpty) || (${charAt('$seq','$j')} !== ';') ) {
				${joinStr('$output', "'&'", '$seg')};
				continue;
			}
			$j++;
		} else {
			${declare('$candidateLen')} = ${searchStr('$seg',"';'")};
			if ($candidateLen == ${searchStrFailed}) {
				${joinStr('$output', "'&'", '$seg')};
				continue;
			}
			${declare('$candidateStr')} = ${subStr('$seg', 0, '$candidateLen')};
			${buildNamedCharRefDecoder()}
		}
		${joinStr('$output', "'&'", '$seg')};
	}
	return $output;
}`;

  const phpNumericCRParser =
`			$chr = $seg[1];
			if (($chr == 'x') || ($chr == 'X')) {
				do {
					$hexChar = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','A','B','C','D','E','F'];
					$hexDigit = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 10, 11, 12, 13, 14, 15];
					$k = array_search($seg[++$j], $hexChar);
					if ($k == false) {
						break;
					} else {
						$cp = $cp * 16 + $hexDig[$k];
					}
				} while (1);
				$isEmpty = $j <= 2;
			} else {
				do {
					$k = array_search($seg[$j], ['0','1','2','3','4','5','6','7','8','9']);
					if ($k == false) break;
					$cp = $cp * 10 + $k;
					$j++;
				} while (1)
				$isEmpty = $j < 1;
			}`;

const jsNumericCRParser =
`			var $cc = $seg.charCodeAt(1);
			if (($cc == ${charCode('x')}) || ($cc == ${charCode('X')})) {
				do {
					$cc = $seg.charCodeAt(++$j);
					if (($cc > ${charCode('0')-1}) && ($cc < ${charCode('9')+1})) { $cp = $cp * 16 + $cc - ${charCode('0')}; }
					else if (($cc > ${charCode('a')-1}) && ($cc < ${charCode('f')+1})) { $cp = $cp * 16 + $cc - ${charCode('a')-10}; }
					else if (($cc > ${charCode('A')-1}) && ($cc < ${charCode('F')+1})) { $cp = $cp * 16 + $cc - ${charCode('A')-10}; }
					else break;
				} while (1);
				$isEmpty = $j <= 2;
			} else {
				while (1) {
					if (($cc < ${charCode('0')}) || ($cc > ${charCode('9')})) break;
					$cp = $cp * 10 + cc - ${charCode('0')};
					$cc = $seg.charCodeAt(++$j);
				}
				$isEmpty = $j < 1;
			}`;
  return decoderSource
    .replace('%%NumericCRParser%%',target=='php'?phpNumericCRParser:jsNumericCRParser);

}

function buildCodePointDecoder() {
  // HTML 5 standard:
  //   A numerical character reference to one of the following non-characters
  //   is an error but should be converted AS-IS.
  //   See https://infra.spec.whatwg.org/#noncharacter
  //
  //   0xFDD0-0xFDEF
  //    0xFFFE,  0xFFFF, 0x1FFFE, 0x1FFFF, 0x2FFFE, 0x2FFFF, 0x3FFFE, 0x3FFFF,
  //   0x4FFFE, 0x4FFFF, 0x5FFFE, 0x5FFFF, 0x6FFFE, 0x6FFFF, 0x7FFFE, 0x7FFFF,
  //   0x8FFFE, 0x8FFFF, 0x9FFFE, 0x9FFFF, 0xAFFFE, 0xAFFFF, 0xBFFFE, 0xBFFFF,
  //   0xCFFFE, 0xCFFFF, 0xDFFFE, 0xDFFFF, 0xEFFFE, 0xEFFFF, 0xFFFFE, 0xFFFFF,
  //   0x10FFFE, 0x10FFFF
  //
  // MediaWiki's current behavior
  //   Replaces a character reference in the range of
  //   [0xFDD0-0xFDEF|0xFFFE|0xFFFF] with 0xFFFD
  //
  // This codepoint decoder:
  //   Replaces a non-character character reference with 0xFFFD
  //
  const nonCharCheck = `(($codepoint > ${0xFDD0-1}) && ($codepoint < ${0xFDEF+1})) || ($codepoint & ${0xFFFF} > ${0xFFFE-1})`;


  // HTML 5 standard:
  //  Control-characters other than 0x09 (tab),
  // 0x0A.
  //   See https://infra.spec.whatwg.org/#noncharacter
  //
  //   0xFDD0-0xFDEF
  //    0xFFFE,  0xFFFF, 0x1FFFE, 0x1FFFF, 0x2FFFE, 0x2FFFF, 0x3FFFE, 0x3FFFF,
  //   0x4FFFE, 0x4FFFF, 0x5FFFE, 0x5FFFF, 0x6FFFE, 0x6FFFF, 0x7FFFE, 0x7FFFF,
  //   0x8FFFE, 0x8FFFF, 0x9FFFE, 0x9FFFF, 0xAFFFE, 0xAFFFF, 0xBFFFE, 0xBFFFF,
  //   0xCFFFE, 0xCFFFF, 0xDFFFE, 0xDFFFF, 0xEFFFE, 0xEFFFF, 0xFFFFE, 0xFFFFF,
  //   0x10FFFE, 0x10FFFF
  //
  // MediaWiki's current behavior
  //   Replaces a character reference in the range of
  //   [0xFDD0-0xFDEF|0xFFFE|0xFFFF] with 0xFFFD
  //
  // This codepoint decoder:
  //   Replaces a non-character character reference with 0xFFFD
  //
  // According to HTML 5 standard,
  // some C0 character references should be replaced
  // https://html.spec.whatwg.org/multipage/parsing.html#numeric-character-reference-end-state
  // https://infra.spec.whatwg.org/#c0-control
  /*
  const C0_REPLACE = [
    { from: 0x80, to: 0x20AC },
    { from: 0x82, to: 0x201A },
    { from: 0x83, to: 0x0192 },
    { from: 0x84, to: 0x201E },
    { from: 0x85, to: 0x2026 },
    { from: 0x86, to: 0x2020 },
    { from: 0x87, to: 0x2021 },
    { from: 0x88, to: 0x02C6 },
    { from: 0x89, to: 0x2030 },
    { from: 0x8A, to: 0x0160 },
    { from: 0x8B, to: 0x2039 },
    { from: 0x8C, to: 0x0152 },
    { from: 0x8E, to: 0x017D },
    { from: 0x91, to: 0x2018 },
    { from: 0x92, to: 0x2019 },
    { from: 0x93, to: 0x201C },
    { from: 0x94, to: 0x201D },
    { from: 0x95, to: 0x2022 },
    { from: 0x96, to: 0x2013 },
    { from: 0x97, to: 0x2014 },
    { from: 0x98, to: 0x02DC },
    { from: 0x99, to: 0x2122 },
    { from: 0x9A, to: 0x0161 },
    { from: 0x9B, to: 0x203A },
    { from: 0x9C, to: 0x0153 },
    { from: 0x9E, to: 0x017E },
    { from: 0x9F, to: 0x0178 }
  ];
  */

  let parserSource =
`decodeChar( $codepoint ) {}
	if ($codepoint > ${0x10FFFF}) ${/*character reference outside unicode range*/''}
		${ReplacementChar}
	} else if ($nbr == 0) {${/*Error: null character reference*/''}
		${ joinStr('$output', ReplacementChar, subStr('$seg','$j') )};
      } else if ( ($nbr > ${0xD800-1}) && ($nbr < ${0xDFFF+1}) ) {${/*Error: surrogate character reference*/''}
        ${ joinStr('$output', ReplacementChar, subStr('$seg','$j') )};
      } else {
        //  U+0009 TAB, U+000A LF, U+000C FF, U+000D CR, or U+0020 SPACE.
        if (${nonCharCheck}) {
          // ${joinStr('$output', "'&'", '$seg')};
        } else if (($nbr < ${0x1F+1}) && ($nbr != ${0x09}) && ($nbr != ${0x0A} && ($nbr != ${0x0C}) {${/*Error: control character character reference*/''}
        } else if (($nbr > ${0x7F-1}) && ($nbr < ${0x9F+1})) {${/*Error: control character character reference*/''}
          // ${declare('$k')} = ${searchArray(`[${C0_REPLACE.map(el => el.from).join(',')}]`,'$nbr')};
          // if ($k >= 0) $nbr = [${C0_REPLACE.map(el => el.to).join(',')}][$k];
        }
        output += String.fromCharCode($nbr) + seg.substring(j);
      }
      continue;`;
  return parserSource;
}

let nameCharRefArrayCache; // storage of lookup arrays that we will cache
function buildNamedCharRefDecoder() {
  let parserSource = '';
  let nameCharRefArrayCacheCount = 0;
  nameCharRefArrayCache = {};

  const entities = html5EntitiesSorted;

  Object.keys(entities).sort( (a,b) => parseInt(a) - parseInt(b) ).forEach((entityLen) => {
    entityLen = parseInt(entityLen);
    const named = entities[entityLen].named;
    const decoded = entities[entityLen].decoded;
    if (parserSource !== '') parserSource += ' else ';
    if (named.length > 2) {
      let namedCacheArray = '$N' + nameCharRefArrayCacheCount;
      let decodedCacheArray = '$D' + nameCharRefArrayCacheCount;
      nameCharRefArrayCache[namedCacheArray] = named;
      nameCharRefArrayCache[decodedCacheArray] = decoded;
      nameCharRefArrayCacheCount ++;
      parserSource +=
     `if ($candidateLen == ${entityLen}) {
        $j = ${searchArray(`${namedCacheArray}`, '$candidateStr')};
        if ($j != ${searchArrayFailed}) {
          ${joinStr('$output', `${decodedCacheArray}[$j]`, subStr('$seg', entityLen+1))};
          continue;
        }
      }`;
    } else if (named.length == 2) {
      parserSource +=
     `if ($candidateLen == ${entityLen}) {
        if ($candidateStr == ${named[0]}) {
          ${joinStr('$output', decoded[0], subStr('$seg', entityLen+1))};
          continue;
        } else if ($candidateStr == ${named[1]}) {
          ${joinStr('$output', decoded[1], subStr('$seg', entityLen+1))};
          continue;
        }
      }`;
    } else {
      parserSource +=
     `if ($candidateStr == ${named[0]}) {
        ${joinStr('$output', decoded[0], subStr('$seg', entityLen+1))};
        continue;
      }`;
    }
  });
  return parserSource;
}

function buildJsDecoderSource() {
  initLanguage('javascript');
  const decoderFunctionSource = buildDecoder();
  const charRefArrayCacheSource =
    Object.keys(nameCharRefArrayCache)
      .map( (key) => `var ${key} = [${nameCharRefArrayCache[key].join(',')}];`)
      .join('\n');

  const source =
`/* THIS IS GENERATED SOURCE. DO NOT EDIT */
/* eslint-disable no-constant-condition */
${charRefArrayCacheSource}
${decoderFunctionSource}
module.exports = {decodeWTEntities};\n`;

  fs.writeFileSync('./build/wt-entities.js', source );
}

function buildPhpDecoderSource() {
  initLanguage('php');
  const decoderFunctionSource = buildDecoder();
  const charRefArrayCacheSource =
    Object.keys(nameCharRefArrayCache)
      .map( (key) => `${key} = [${nameCharRefArrayCache[key].join(',')}];`)
      .join('\n');

  const source =
`<?php
/* THIS IS GENERATED SOURCE. DO NOT EDIT */
${charRefArrayCacheSource}

/**
 * Decode any character references, numeric or named entities,
 * in the text and return a UTF-8 string.
 *
 * @param string $text
 * @return string
 */
public static ${decoderFunctionSource}

/**
 * Return UTF-8 string for a codepoint if that is a valid
 * character reference, otherwise U+FFFD REPLACEMENT CHARACTER.
 * @param int $codepoint
 * @return string
 */
public static ${buildCodePointDecoder}
?>\n`;

  fs.writeFileSync('./build/wt-entities.php', source );
}

/*
// Character entity aliases accepted by MediaWiki
// See mediawiki/includes/parser/Sanitizer.php
// 'רלמ' => 'rlm',
// 'رلم' => 'rlm',
entities['&רלמ;'] = Object.assign({}, entities['&rlm;']);
entities['&رلم;'] = Object.assign({}, entities['&rlm;']);
const entitiesAliases = ['רלמ','رلم'];
*/

buildJsDecoderSource();
buildPhpDecoderSource();
