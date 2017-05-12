<?php

namespace Phpmnfy;

class Strip
{
	public static function newlines($input) {
		return preg_replace('/(\r\n|\r|\n)/', '', $input);
	}

	public static function tabs($input) {
		return preg_replace('/\t/', '', $input);
	}

	public static function inlineComments($input) {
		return preg_replace('/\/\/.*\n/', '', $input);
	}

	public static function multilineComments($input) {
		return preg_replace('|\/\*[.\s\w]*\*\/\s+|m', '', $input);
	}
}