<?php

use PHPUnit\Framework\TestCase;
use Phpmnfy\Util\Strip;

final class StripTest extends TestCase
{
    public function getTestFiles($fileName)
    {
        $input          = file_get_contents(__DIR__ . '/../resources/input/' . $fileName);
        $expectedOutput = file_get_contents(__DIR__ . '/../resources/expectedOutput/' . $fileName);
        return [$input, $expectedOutput];
    }

    public function testStripNewlines()
    {
        list($raw, $minimized) = $this->getTestFiles('newline.css');
        $this->assertEquals($minimized, Strip::newlines($raw));
    }

    public function testStripTabs()
    {
        list($raw, $minimized) = $this->getTestFiles('tabs.css');
        $this->assertEquals($minimized, Strip::tabs($raw));
    }

    public function testStripInlineComments()
    {
        list($raw, $minimized) = $this->getTestFiles('comments_inline.css');
        $this->assertEquals($minimized, Strip::inlineComments($raw));
    }

    /**
     * @todo: removing a comment might cause a problem with a tabulator,
     * see ../resources/expectedOutput comments_multiline.css:5 as example
     */
    public function testStripMultilineComments()
    {
        list($raw, $minimized) = $this->getTestFiles('comments_multiline.css');
        $this->assertEquals($minimized, Strip::multilineComments($raw));
    }
}
