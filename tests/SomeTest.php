<?php

use PHPUnit\Framework\TestCase; 

function strip_newlines($input) {
	return preg_replace('/(\r\n|\r|\n)/', '', $input);
}

function strip_tabs($input) {
	return preg_replace('/\t/', '', $input);
}

function strip_inline_comments($input) {
	return preg_replace('/\/\/.*\n/', '', $input);
}

final class SomeTest extends TestCase
{
	public function testStripNewlines()
	{
		$formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
}
EOT;
		$minified = 'div.container {	padding: 12px 6px;}';
		$this->assertEquals($minified, strip_newlines($formatted));
	}

	public function testStripTabs()
	{
		$formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
	margin-top: 8px;
}
EOT;
		$minified = <<<'EOT'
div.container {
padding: 12px 6px;
margin-top: 8px;
}
EOT;
		$this->assertEquals($minified, strip_tabs($formatted));
	}

	public function testStripTabsAndNewlines()
	{
		$formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
	margin-top: 8px;
}
EOT;
		$minified = 'div.container {padding: 12px 6px;margin-top: 8px;}';
		$this->assertEquals($minified, strip_tabs(
				strip_newlines($formatted)
			)
		);
	}

	public function testStripInlineComments()
	{
		$formatted = <<<EOT
// “This License” refers to version 3 of the GNU General Public License.
var props = {
	margin: 0,
	padding: 0
};
EOT;
		$minified = <<<EOT
var props = {
	margin: 0,
	padding: 0
};
EOT;
		$this->assertEquals($minified, strip_inline_comments($formatted));
	}
}