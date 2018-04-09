<?php

use PHPUnit\Framework\TestCase;
use Phpmnfy\Util\Strip;

final class StripTest extends TestCase
{
    public function testStripNewlines()
    {
        $formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
}
EOT;
        $minimized = 'div.container {	padding: 12px 6px;}';
        $this->assertEquals($minimized, Strip::newlines($formatted));
    }

    public function testStripTabs()
    {
        $formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
	margin-top: 8px;
}
EOT;
        $minimized = <<<'EOT'
div.container {
padding: 12px 6px;
margin-top: 8px;
}
EOT;
        $this->assertEquals($minimized, Strip::tabs($formatted));
    }

    public function testStripTabsAndNewlines()
    {
        $formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
	margin-top: 8px;
}
EOT;
        $minimized = 'div.container {padding: 12px 6px;margin-top: 8px;}';
        $this->assertEquals(
            $minimized,
            Strip::tabs(
                Strip::newlines($formatted)
            )
        );
    }

    public function testStripInlineComments()
    {
        $formatted = <<<'EOT'
// “This License” refers to version 3 of the GNU General Public License.
var props = {
	margin: 0,
	padding: 0
};
EOT;
        $minimized = <<<'EOT'
var props = {
	margin: 0,
	padding: 0
};
EOT;
        $this->assertEquals($minimized, Strip::inlineComments($formatted));
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
        $minimized = <<<'EOT'
html {
	margin: 0;
	padding: 0;
	background: red;
	};
EOT;
        $this->assertEquals($minimized, Strip::multilineComments($formatted));
    }
}
