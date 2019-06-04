
/* THIS IS GENERATED SOURCE. DO NOT EDIT */
/* eslint-disable no-constant-condition */
const WtEntities = function() {
  /**
   * Decode any character references, numeric or named entities,
   * in the text and return a UTF-8 string.
   * ```
   * decodeCharReferences('&quot;a & b&quot;'); // returns '"a & b"'
   * ```
   *
   * @param {string} $text
   * @return {string}
   */
  this.decodeCharReferences = function($text) {
    /*%%DECODE_CHAR_REFERENCES%%*/
  };

  /**
   * Return UTF-8 string for a codepoint if that is a valid
   * character reference, otherwise U+FFFD REPLACEMENT CHARACTER.
   * ```
   * decodeCodepoint(0x30); // returns '0'
   * decodeCodepoint(0); // returns '\uFFFD'
   * ```
   *
   * @param {number} $codepoint
   * @return {string}
   */
  this.decodeCodepoint = function($codepoint) {
    /*%%DECODE_CODEPOINT%%*/
  };

  /**
   * Return UTF-8 string for a named entity if that is a valid
   * character reference, otherwise pseudo-entity source
   * ```
   * decodeEntity('amp'); // returns '&'
   * decodeEntity('foo'); // returns '&foo;'
   * ```
   *
   * @param {string} $name
   * @return {string}
   */
  this.decodeEntity = function($name) {
    /*%%DECODE_ENTITY%%*/
  };

};

/*%%CHAR_REF_ARRAY_CACHE%%*/

const wtEntities = new WtEntities();
module.exports = wtEntities;
