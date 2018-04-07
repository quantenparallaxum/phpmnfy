<?php

use PHPUnit\Framework\TestCase;
use Phpmnfy\Strip;

final class StrippingCharactersTest extends TestCase
{
    public function testStripNewlines()
    {
        $formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
}
EOT;
        $minified = 'div.container {	padding: 12px 6px;}';
        $this->assertEquals($minified, Strip::newlines($formatted));
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
        $this->assertEquals($minified, Strip::tabs($formatted));
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
        $this->assertEquals(
            $minified,
            Strip::tabs(
                Strip::newlines($formatted)
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
        $this->assertEquals($minified, Strip::inlineComments($formatted));
    }

    public function testStripMultilineComments()
    {
        $formatted = <<<'EOT'
html {
	/* margin */
	margin: 0;
	/* 
		reset 
		the
		padding 
	*/
	padding: 0;
	/* end of comments */
	background: red;
	/* really the end of comments */
};
EOT;
        $minified = <<<EEE
html {
	margin: 0;
	padding: 0;
	background: red;
	};
EEE;
        $this->assertEquals($minified, Strip::multilineComments($formatted));
    }
}
