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
function initLanguage(lang) {
  target = lang;

  declare =  (v) => target !== 'php'? `var ${v}`    : v ;

  strLen =   (v) => target !== 'php'? `${v}.length` : `strlen(${v})`;
  arrayLen = (v) => target !== 'php'? `${v}.length` : `count(${v})`;

  splitStr = (v, sep) => target !== 'php' ? `${v}.split('${sep}')`: `explode('${sep}', $${v})`;
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
}

function charCode(s) { return s.charCodeAt(0); }

function buildDecoderFunction() {
  return `function decodeWTEntities($input) {
  if (${strLen('$input')} == 0) return '';

  ${declare('$segments')} = ${splitStr('$input','&')};
  if (${arrayLen('$segments')} == 1) return $input;

  ${declare('$output')} = $segments[0];
  ${declare('$j')} = 0;
  ${declare('$i')} = 1;
  for (; $i < ${arrayLen('$segments')}; $i++) {
    ${declare('$seg')} = $segments[$i];
    if (${charAt('$seg',0)} == '#') {
      ${buildNumericCharRefDecoder()}
    } else {
      ${declare('$candidateLen')} = ${searchStr('$seg',"';'")};
      if ($candidateLen == ${searchStrFailed}) {
        // Error: missing semicolon after character reference
        ${joinStr('$output', "'&'", '$seg')};
        continue;
      }
      ${declare('$candidateStr')} = ${subStr('$seg', 0, '$candidateLen')};
      ${buildNamedCharRefDecoder()}
      // Error: unknown named character reference
    }
    ${joinStr('$output', "'&'", '$seg')};
  }
  return $output;
}`;

}

const ERRORS = {
  NULL_CHAR_REF:         { CODE: 0, MSG: "null character reference" },
  OUT_OF_RANGE_CHAR_REF: { CODE: 1, MSG: "character reference outside unicode range" },
  SURROGATE_CHAR_REF:    { CODE: 2, MSG: "surrogate character reference" },
  NON_CHARACTER:         { CODE: 3, MSG: "non-character character reference" },
  CTRL_CHARACTER:        { CODE: 4, MSG: "control character character reference" },
  MISSING_DIGIT:         { CODE: 6, MSG: "missing digit in numeric character reference" },
  UNKNOWN_NAMED_CHAR_REF:{ CODE: 7, MSG: "unknown named character reference" },
  MISSING_SEMICOLON:     { CODE: 9, MSG: "missing semicolon after character reference" },
};
function buildNumericCharRefDecoder() {
  // According to HTML 5 standard, a numerical character reference to one
  // of the following non-characters is an error. However, browser should
  // convert as-is
  // See https://infra.spec.whatwg.org/#noncharacter
  //
  // 0xFDD0-0xFDEF
  // 0xFFFF,
  // 0x1FFFE, 0x1FFFF, 0x2FFFE, 0x2FFFF, 0x3FFFE, 0x3FFFF, 0x4FFFE, 0x4FFFF,
  // 0x5FFFE, 0x5FFFF, 0x6FFFE, 0x6FFFF, 0x7FFFE, 0x7FFFF, 0x8FFFE, 0x8FFFF,
  // 0x9FFFE, 0x9FFFF, 0xAFFFE, 0xAFFFF, 0xBFFFE, 0xBFFFF, 0xCFFFE, 0xCFFFF,
  // 0xDFFFE, 0xDFFFF, 0xEFFFE, 0xEFFFF, 0xFFFFE, 0xFFFFF, 0x10FFFE, 0x10FFFF
  const nonCharCheck = `(($nbr > ${0xFDD0-1}) && ($nbr < ${0xFDEF+1})) || ($nbr & ${0xFFFF} > ${0xFFFE-1})`;

  // According to HTML 5 standard, some C0 character references should be replaced
  // https://html.spec.whatwg.org/multipage/parsing.html#numeric-character-reference-end-state
  // https://infra.spec.whatwg.org/#c0-control
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

  const phpNumberParserSource =
  `      $chr = $seg[1];
        $j = 1;
        if (($chr == 'x') || ($chr == 'X')) {
          do {
            $k = array_search($seg[++$j], $hexChar);
            if ($k == false) break;
            else $nbr = $nbr * 16 + $hexDig[$k]
          } while (1);
          $isEmpty = $j <= 2;
        } else {
          do {
            $k = array_search($seg[$j], $decChar);
            if ($k == false) break;
            $nbr = $nbr * 10 + $k;
            $j++;
          } while (1)
          $isEmpty = $j < 1;
        }`;

  const jsNumberParserSource =
  `      var $cc = $seg.charCodeAt(1);
        $j = 1;
        if (($cc == 'x') || ($cc == 'X')) {
           do {
             $cc = $seg.charCodeAt(++$j);
             if (($cc > ${charCode('0')-1}) && ($cc < ${charCode('9')+1})) { $nbr = $nbr * 16 + $cc - ${charCode('0')}; }
             else if (($cc > ${charCode('a')-1}) && ($cc < ${charCode('f')+1})) { $nbr = $nbr * 16 + $cc - ${charCode('a')-10}; }
             else if (($cc > ${charCode('A')-1}) && ($cc < ${charCode('F')+1})) { $nbr = $nbr * 16 + $cc - ${charCode('A')-10}; }
             else break;
           } while (1);
           $isEmpty = $j <= 2;
        } else {
          while (1) {
            if (($cc < ${charCode('0')}) || ($cc > ${charCode('9')})) break;
            $nbr = $nbr * 10 + cc - ${charCode('0')};
            $cc = $seg.charCodeAt(++$j);
           }
           $isEmpty = $j < 1;
        }`;

  let parserSource =
     `${declare('$nbr')} = 0;
      ${declare('$isEmpty')} = false;
      ${declare('$char')} = ${charAt('$seg',1)};
      ${target == 'php' ? phpNumberParserSource : jsNumberParserSource}
      if ( ($isEmpty)${''/*Error: missing digit in numeric character reference*/} ||
          (${charAt('$seq','$j')} !== ';')${''/*Error: missing semicolon after character reference*/}
      ) {
        ${joinStr('$output', "'&'", '$seg')};
        continue;
      }
      $j++;
      if ($nbr > ${0x10FFFF}) { // Error: character reference outside unicode range
        ${ joinStr('$output', "'\\uFFFD'", subStr('$seg','$j') )};
      } else if ($nbr == 0) { // Error: null character reference
        ${ joinStr('$output', "'\\uFFFD'", subStr('$seg','$j') )};
      } else if ( ($nbr > ${0xD800-1}) && ($nbr < ${0xDFFF+1}) ) {
        // Error: surrogate character reference
        ${ joinStr('$output', "'\\uFFFD'", subStr('$seg','$j') )};
      } else {
        if (${nonCharCheck}) {
          // ${joinStr('$output', "'&'", '$seg')};
          // continue;
        } else if (($nbr == ${0x0D}) || ($nbr < ${0x001F+1})) {
          parseError("${ERRORS.CTRL_CHARACTER.MSG}",${ERRORS.CTRL_CHARACTER.CODE});
        } else if (($nbr > ${0x007F-1}) && ($nbr < ${0x009F+1})) {
          parseError("${ERRORS.CTRL_CHARACTER.MSG}",${ERRORS.CTRL_CHARACTER.CODE});
          var k = [${C0_REPLACE.map(el => el.from).join(',')}].indexOf($nbr);
          if (k >= 0) $nbr = [${C0_REPLACE.map(el => el.to).join(',')}][k];
        }
          output += String.fromCharCode($nbr) + seg.substring(j);
      }
      continue;`;
      /*
      $codepoint == 0x09
			|| $codepoint == 0x0a
			|| ( $codepoint >= 0x20 && $codepoint <= 0x7e )
			|| ( $codepoint >= 0xa0 && $codepoint <= 0xd7ff )
			|| ( $codepoint >= 0xe000 && $codepoint <= 0xfffd )
			|| ( $codepoint >= 0x10000 && $codepoint <= 0x10ffff );
      */
  return parserSource.replace('%%HEX_PARSER%%', hexParserSource );
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
  const decoderFunctionSource = buildDecoderFunction();
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
  const decoderFunctionSource = buildDecoderFunction();
  const charRefArrayCacheSource =
    Object.keys(nameCharRefArrayCache)
      .map( (key) => `${key} = [${nameCharRefArrayCache[key].join(',')}];`)
      .join('\n');

  const source =
`<?php
/* THIS IS GENERATED SOURCE. DO NOT EDIT */
$hexChar = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','A','B','C','D','E','F'];
$hexDigit = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 10, 11, 12, 13, 14, 15];
$decChar = ['0','1','2','3','4','5','6','7','8','9'];
${charRefArrayCacheSource}
private ${decoderFunctionSource}
?>\n`;

  fs.writeFileSync('./build/wt-entities.php', source );
}

buildJsDecoderSource();
buildPhpDecoderSource();
