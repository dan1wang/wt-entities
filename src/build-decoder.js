/*
 * Tool for building code for decoding named and numeric character references
 *
 * Code according to rule specified by
 * https://html.spec.whatwg.org/multipage/parsing.html#character-reference-state
 */

const fs = require('fs');
const path = require('path');
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
let codepointToUtf8; // string.fromCharCode(cp)
let Self; // 'this.' / 'self::'
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

  searchArrayFailed = target !== 'php'?'-1':'false';
  searchStrFailed = target !== 'php'?'-1':'false';

  subStr = (v, start, end) => {
    return target !== 'php'
      ? (end === undefined ? `${v}.substring(${start})` : `${v}.substring(${start},${end})`)
      : (end === undefined ? `substr(${v},${start})||''` : `substr(${v},${start},${end})`);
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

  ReplacementChar = target !== 'php'?'"\\uFFFD"':'"\\u{FFFD}"';
  Self = target !== 'php'? 'this.' : 'self::';

  codepointToUtf8 = (cp) => target !== 'php'? `String.fromCharCode(${cp})` : `UtfNormal\\Utils::codepointToUtf8( ${cp} )`;
}

function buildDecodFunction() {
  const decoderSource =
		`if (${strLen('$text')} == 0) return '';
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
				if ( ($isEmpty) || (${charAt('$seg','$j')} !== ';') ) {
					${joinStr('$output', "'&'", '$seg')};
				} else {
					${joinStr('$output', `${Self}decodeCodepoint($cp)`, subStr('$seg', 0, '++$j'))};
				}
			} else {
				${declare('$len')} = ${searchStr('$seg',"';'")};
				if ($len == ${searchStrFailed}) {
					${joinStr('$output', "'&'", '$seg')};
				} else {
					${declare('$entity')} = ${Self}decodeEntity(${subStr('$seg', 0, '$len')});
					${joinStr('$output', '$entity', subStr('$seg', 0, '++$len'))};
				}
			}
		}
		return $output;`;

  const phpNumericCRParser =
				`$chr = $seg[1];
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
					} while (1);
					$isEmpty = $j < 1;
				}`;

  const charCode = (s) => s.charCodeAt(0);
  const jsNumericCRParser =
				`var $cc = $seg.charCodeAt(1);
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
						$cp = $cp * 10 + $cc - ${charCode('0')};
						$cc = $seg.charCodeAt(++$j);
					}
					$isEmpty = $j < 1;
				}`;

  return decoderSource
    .replace('%%NumericCRParser%%',target=='php'?phpNumericCRParser:jsNumericCRParser);

}

function buildDecodeCodepointFunction() {
  // HTML 5 standard:
  //   A numerical character reference to one of the following non-characters
  //   is an error but should be resolved AS-IS.
  //
  //   [#xFDD0-#xFDEF] |
  //    #xFFFE |  #xFFFF | #x1FFFE | #x1FFFF | #x2FFFE | #x2FFFF | #x3FFFE | #x3FFFF |
  //   #x4FFFE | #x4FFFF | #x5FFFE | #x5FFFF | #x6FFFE | #x6FFFF | #x7FFFE | #x7FFFF |
  //   #x8FFFE | #x8FFFF | #x9FFFE | #x9FFFF | #xAFFFE | #xAFFFF | #xBFFFE | #xBFFFF |
  //   #xCFFFE | #xCFFFF | #xDFFFE | #xDFFFF | #xEFFFE | #xEFFFF | #xFFFFE | #xFFFFF |
  //   #x10FFFE | #x10FFFF
  //
  //   See https://infra.spec.whatwg.org/#noncharacter
  //
  // MediaWiki's current behavior
  //   Replaces a character reference in the following range with 0xFFFD:
  //
  //   [#xFDD0-#xFDEF] | #xFFFE | #xFFFF
  //
  // This codepoint decoder:
  //   Replaces a non-character character reference with 0xFFFD
  //
  const NON_CHAR_CHECK = `(($codepoint > ${0xFDD0-1}) && ($codepoint < ${0xFDEF+1})) || ($codepoint & ${0xFFFF} > ${0xFFFE-1})`;

  // HTML 5 standard:
  //   A C0 control character other than one of the following is an error
  //   but should be resolved AS-IS.
  //
  //   0x9 | 0xA | 0xC |     | 0x20
  //
  //   See https://html.spec.whatwg.org/multipage/parsing.html#numeric-character-reference-end-state
  //   See https://infra.spec.whatwg.org/#c0-control
  //
  // XML standard:
  //   A C0 control character other than one of the following is an error:
  //
  //   0x9 | 0xA |     | 0xD | 0x20
  //
  //   See https://www.w3.org/TR/xml/#charsets
  //
  // MediaWiki's current behavior
  //   A C0 control characters other than the following is an error and replaced with 0xFFFD:
  //
  //   0x9 | 0xA |     |     | 0x20
  //
  const C0_CHAR_CHECK = `($codepoint < ${0x1F+1}) && ($codepoint != ${0x09}) && ($codepoint != ${0x0A})`;

  // HTML 5 standard:
  //   A C1 control character is an error and is either replaced or resolved AS-IS
  //
  //   See https://html.spec.whatwg.org/multipage/parsing.html#numeric-character-reference-end-state
  //
  // XML standard:
  //   A C1 control characters other than 0x85 is an error:
  //
  //   See https://www.w3.org/TR/xml/#charsets
  //
  // MediaWiki's current behavior
  //   A C1 control characters is an error and replaced with 0xFFFD
  //
  const C1_CHAR_CHECK = `($codepoint > ${0x7F-1}) && ($codepoint < ${0x9F+1})`;

  // HTML 5 standard:
  //   A surrogate character reference is an error and replaced with 0xFFFD
  //
  // XML standard:
  //   A surrogate character reference is an error
  //
  // MediaWiki's current behavior
  //   A surrogate character reference is an error and replaced with 0xFFFD
  //
  const SURROGATE_CHECK = `($codepoint > ${0xD800-1}) && ($codepoint < ${0xDFFF+1})`;

  let parserSource =
		`if (($codepoint > ${0x10FFFF}) ||
			(${C0_CHAR_CHECK}) ||
			(${C1_CHAR_CHECK}) ||
			(${NON_CHAR_CHECK}) ||
			(${SURROGATE_CHECK})) {
			return ${ReplacementChar};
		} else {
			return ${codepointToUtf8('$codepoint')};
		}`;
  return parserSource;
}

let nameCharRefArrayCache; // storage of lookup arrays that we will cache
let nameCharRefArrayCacheCount;
function buildDecodeEntityFunction() {
  nameCharRefArrayCacheCount = 0;
  nameCharRefArrayCache = {};
  let decoderSource = '';
  const entities = html5EntitiesSorted;

  Object.keys(entities)
    .sort( (a,b) => parseInt(a) - parseInt(b) )
    .forEach((entityLen) => {
      entityLen = parseInt(entityLen);
      const named = entities[entityLen].named; // e.g. ['"gt"','"ac"','"af"'...]
      const decoded = target == 'php'
        ? entities[entityLen].decodedPhp // e.g. ['">"','"\u{223E}"','"\u{2061}"'...]
        : entities[entityLen].decoded;   // e.g. ['">"','"\u223E"', '"\u2061"'...]
      if (decoderSource !== '') decoderSource += ' else ';
      if (named.length > 2) {
        let namedCacheArray = '$N' + nameCharRefArrayCacheCount;
        let decodedCacheArray = '$D' + nameCharRefArrayCacheCount;
        nameCharRefArrayCache[namedCacheArray] = named;
        nameCharRefArrayCache[decodedCacheArray] = decoded;
        nameCharRefArrayCacheCount ++;
        decoderSource +=
		`if ($len == ${entityLen}) {
			$j = ${searchArray(`${namedCacheArray}`, '$name')};
			if ($j != ${searchArrayFailed}) return ${decodedCacheArray}[$j];
		}`;
      } else if (named.length == 2) {
        decoderSource +=
		`if ($name == ${named[0]}) {
			return ${decoded[0]};
		} else if ($name == ${named[1]}) {
			return ${decoded[1]};
		}`;
      } else {
        decoderSource +=
		`if ($name == ${named[0]}) {
			return ${decoded[0]};
		}`;
      }
    });

  decoderSource =
		`${declare('$len')} = ${strLen('$name')};
		${declare('$j')} = 0;
		${decoderSource}
		return ${joinStr(undefined,"'&'",'$name',"';'")};`;

  return decoderSource;
}

function buildDecoderSource(targetLang) {
  initLanguage(targetLang !== 'php'?'javascript':'php');
  const fileExt = targetLang !== 'php'?'.js':'.php';
  const decodeFunctionSrc = buildDecodFunction();
  const decodeEntityFunctionSrc = buildDecodeEntityFunction();
  const decodeCodepointFunctionSrc = buildDecodeCodepointFunction();
  const charRefArrayCacheSource =
    Object.keys(nameCharRefArrayCache)
      .map( (varName) => `${declare(varName)} = [${nameCharRefArrayCache[varName].join(',')}];`)
      .join('\n');

  let source =
    fs.readFileSync(path.join(__dirname, 'template' + fileExt), 'utf8')
      .replace('/*%%DECODE_CHAR_REFERENCES%%*/', decodeFunctionSrc)
      .replace('/*%%DECODE_CODEPOINT%%*/', decodeCodepointFunctionSrc)
      .replace('/*%%DECODE_ENTITY%%*/', decodeEntityFunctionSrc)
      .replace('/*%%CHAR_REF_ARRAY_CACHE%%*/', charRefArrayCacheSource);

  if (targetLang != 'php') source = source.replace(/\t/g, '  ');

  fs.writeFileSync(
    path.join(__dirname, '../build/wt-entities' + fileExt),
    source
  );
}

// TODO:
// Character entity aliases accepted by MediaWiki
// See mediawiki/includes/parser/Sanitizer.php
// 'רלמ' => 'rlm',
// 'رلم' => 'rlm',

buildDecoderSource('javascript');
buildDecoderSource('php');
