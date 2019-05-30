/*
 * Tool for building code for decoding named and numeric character references
 *
 * Code according to rule specified by
 * https://html.spec.whatwg.org/multipage/parsing.html#character-reference-state
 */

const fs = require('fs');
const { html5EntitiesSorted } = require('./entities-dict');

let target = 'javascript';

// declare a variable
const declare = (varName) => {
  return target == 'php'
    ? varName
    : `var ${varName}`;
};

// get string.length expression
const strLen = (v) => target == 'php'?`strlen(${v})`:`${v}.length`;

// get array.length expression
const arrayLen = (v) => target == 'php'?`count(${v})`:`${v}.length`;

// get string.split expression
const splitStr = (varName, seperator) => {
  return target == 'php'
    ? `explode('${seperator}', $${varName})`
    : `${varName}.split('${seperator}')`;
};

// get string.charAt expression
const charAt = (varName, pos) => {
  return target == 'php'
    ? `${varName}[${pos}]`
    : `${varName}.charAt(${pos})`;
};

// get string.indexOf expression
const searchStr = (varName, searchStr) => {
  return target == 'php'
    ? `strpos(${varName},${searchStr})`
    : `${varName}.indexOf(${searchStr})`;
};

// get string.indexOf expression
const searchArray = (varName, searchVal) => {
  return target == 'php'
    ? `array_search(${searchVal},${varName})`
    : `${varName}.indexOf(${searchVal})`;
};

let searchArrayFailed = target == 'php'?'false':'-1';

const subStr = (varName, start, end) => {
  return target == 'php'
    ? (end === undefined ? `substr(${varName},${start})||''` : `substr(${varName},${start},${end})||''` )
    : (end === undefined ? `${varName}.substring(${start})` : `${varName}.substring(${start},${end})`);
};

const joinStr = (varName, ...strings) => {
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

function charCode(s) { return s.charCodeAt(0); }

function buildDecoder() {
  return `function($input) {
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
      ${declare('$candidateStr')} = ${subStr('$seg', 0, '$candidateLen')};
      ${buildNamedCharRefDecoder()}
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
  // https://infra.spec.whatwg.org/#noncharacter
  const NON_CHARACTER = [
    /* 0xFDD0-0xFDEF (range comparision used) */
    0xFFFF, 0x1FFFE, 0x1FFFF, 0x2FFFE, 0x2FFFF, 0x3FFFE, 0x3FFFF, 0x4FFFE,
    0x4FFFF, 0x5FFFE, 0x5FFFF, 0x6FFFE, 0x6FFFF, 0x7FFFE, 0x7FFFF, 0x8FFFE,
    0x8FFFF, 0x9FFFE, 0x9FFFF, 0xAFFFE, 0xAFFFF, 0xBFFFE, 0xBFFFF, 0xCFFFE,
    0xCFFFF, 0xDFFFE, 0xDFFFF, 0xEFFFE, 0xEFFFF, 0xFFFFE, 0xFFFFF, 0x10FFFE,
    0x10FFFF
  ];

  // https://html.spec.whatwg.org/multipage/parsing.html#numeric-character-reference-end-state
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

  let parserSource =
     `$j = 1;
      ${declare('$char')} = ${charAt('$seg',1)};
      ${declare('$nbr')} = 0;
      ${declare('$isEmpty')} = false;
      if (($char == 'x') || ($char == 'X')) {
        do {
          %%HEX_PARSER%%
        } while (1);
        $isEmpty = $j <= 2;
      } else {
        while (1) {
          if ((cc < ${'0'.charCodeAt(0)}) || (cc > ${'9'.charCodeAt(0)})) break;
          num = num * 10 + cc - ${'0'.charCodeAt(0)};
          cc = $seg.charCodeAt(++j);
        }
        $isEmpty = $j < 1;
      }
      if ($isEmpty) {
          ${joinStr('$output', "'&'", '$seg')}; // Error: missing digit in numeric character reference
          continue;
      }
      if (cc == ${';'.charCodeAt(0)}) {
          j++;
      } else if (strict) {
          parseError("${ERRORS.MISSING_SEMICOLON.MSG}",${ERRORS.MISSING_SEMICOLON.CODE});
          output += '&' + seg;
          continue;
      }
      if (num > ${0x10FFFF}) {
          parseError("${ERRORS.OUT_OF_RANGE_CHAR_REF.MSG}",${ERRORS.OUT_OF_RANGE_CHAR_REF.CODE});
          output += '\\uFFFD' + seg.substring(j);
      } else if (num == 0) {
          parseError("${ERRORS.NULL_CHAR_REF.MSG}",${ERRORS.NULL_CHAR_REF.CODE});
          output += '\\uFFFD' + seg.substring(j);
      } else if ( (num > ${0xD800-1}) && (num < ${0xDFFF+1}) ) {
          parseError("${ERRORS.SURROGATE_CHAR_REF.MSG}",${ERRORS.SURROGATE_CHAR_REF.CODE});
          output += '\\uFFFD' + seg.substring(j);
      } else {` + /* https://infra.spec.whatwg.org/#c0-control */ `
          if (((num > ${0xFDD0-1}) && (num < ${0xFDEF+1})) || ([${NON_CHARACTER.join(',')}].indexOf(num) >= 0)) {
              parseError("${ERRORS.NON_CHARACTER.MSG}",${ERRORS.NON_CHARACTER.CODE});
          } else if ((num == ${0x0D}) || (num < ${0x001F+1})) {
              parseError("${ERRORS.CTRL_CHARACTER.MSG}",${ERRORS.CTRL_CHARACTER.CODE});
          } else if ((num > ${0x007F-1}) && (num < ${0x009F+1})) {
              parseError("${ERRORS.CTRL_CHARACTER.MSG}",${ERRORS.CTRL_CHARACTER.CODE});
              var k = [${C0_REPLACE.map(el => el.from).join(',')}].indexOf(num);
              if (k >= 0) num = [${C0_REPLACE.map(el => el.to).join(',')}][k];
          }
          output += String.fromCharCode(num) + seg.substring(j);
      }
      continue;`;
  const hexParserSource =
       target == 'php'
         ? `$cc  = $seg[++$j];
         $k = array_search($cc, $hexChar);
         if ($k == false) break;
         else $nbr = $nbr * 16 + $hexDig[$k]`
         : `var cc = $seg.charCodeAt(++$j);
          if ((cc > ${charCode('0')-1}) && (cc < ${charCode('9')+1})) { $nbr = $nbr * 16 + $char - ${charCode('0')}; }
          else if ((cc > ${charCode('a')-1}) && (cc < ${charCode('f')+1})) { $nbr = $nbr * 16 + cc - ${'a'.charCodeAt(0) - 10}; }
          else if ((cc > ${charCode('A')-1}) && (cc < ${charCode('F')+1})) { $nbr = $nbr * 16 + cc - ${'A'.charCodeAt(0) - 10}; }
          else break;`;

  return parserSource.replace('%%HEX_PARSER%%', hexParserSource );
}

function buildNamedCharRefDecoder() {
  let parserSource = '';
  const entities = html5EntitiesSorted;
  Object.keys(entities).sort( (a,b) => parseInt(a) - parseInt(b) ).forEach((entityLen) => {
    entityLen = parseInt(entityLen);
    const named = entities[entityLen].named;
    const decoded = entities[entityLen].decoded;
    if (parserSource !== '') parserSource += ' else ';
    if (named.length > 2) {
      parserSource +=
     `if ($candidateLen == ${entityLen}) {
        $j = ${searchArray(`[${named.join(',')}]`, '$candidateStr')};
        if ($j != ${searchArrayFailed}) {
          ${joinStr('$output', `[${decoded.join(',')}][$j]`, subStr('$seg', entityLen+1))};
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

const jsDecoderSource =
`/* THIS IS GENERATED SOURCE. DO NOT EDIT */

/* eslint-disable no-constant-condition */

var decodeWTEntities = ${buildDecoder()}

module.exports = {decodeWTEntities};
`;

fs.writeFileSync('./build/wt-entities.js', jsDecoderSource);

target = 'php';
const phpDecoderSource =
`<?php

$hexChar = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','A','B','C','D','E','F'];
$hexDigit = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 10, 11, 12, 13, 14, 15];
$decChar = ['0','1','2','3','4','5','6','7','8','9'];

decodeWTEntities = ${buildDecoder()}

?>`
fs.writeFileSync('./build/wt-entities.php', phpDecoderSource);
