<?php
/* THIS IS GENERATED SOURCE. DO NOT EDIT */

class wtEntities {
	/**
	 * Decode any character references, numeric or named entities,
	 * in the text and return a UTF-8 string.
	 * ```
	 * decodeCharReferences('&quot;a & b&quot;'); // returns '"a & b"'
	 * ```
	 *
	 * @param string $text
	 * @return string
	 */
	public static function decodeCharReferences($text) {
		/*%%DECODE_CHAR_REFERENCES%%*/
	}

	/**
	 * Return UTF-8 string for a codepoint if that is a valid
	 * character reference, otherwise U+FFFD REPLACEMENT CHARACTER.
	 * ```
	 * decodeCodepoint(0x30); // returns '0'
	 * decodeCodepoint(0); // returns '\u{FFFD}'
	 * ```
	 *
	 * @param int $codepoint
	 * @return string
	 */
	public static function decodeCodepoint($codepoint) {
		/*%%DECODE_CODEPOINT%%*/
	}

	/**
	 * Return UTF-8 string for a named entity if that is a valid
	 * character reference, otherwise pseudo-entity source
	 * ```
	 * decodeEntity('amp'); // returns '&'
	 * decodeEntity('foo'); // returns '&foo;'
	 * ```
	 *
	 * @param string $name
	 * @return string
	 */
	public static function decodeEntity($name) {
 		/*%%DECODE_ENTITY%%*/
 	}
}
/*%%CHAR_REF_ARRAY_CACHE%%*/
?>
