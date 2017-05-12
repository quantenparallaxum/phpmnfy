<?php

namespace Phpmnfy;

class Strip
{
	public static function strip_newlines($input) {
		return preg_replace('/(\r\n|\r|\n)/', '', $input);
	}

	public static function strip_tabs($input) {
		return preg_replace('/\t/', '', $input);
	}

	public static function strip_inline_comments($input) {
		return preg_replace('/\/\/.*\n/', '', $input);
	}

	public static function strip_multiline_comments($input) {
		return preg_replace('|\/\*[.\s\w]*\*\/\s+|m', '', $input);
	}
}