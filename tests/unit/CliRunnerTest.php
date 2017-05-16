<?php

use PHPUnit\Framework\TestCase; 
use Phpmnfy\Runner as phpmnfy;

final class CliRunnerTest extends TestCase
{
	public function testCliRunner()
	{
		$formatted = <<<'EOT'
div.container {
	padding: 12px 6px;
	margin: 0;
}
EOT;
		$minified = 'div.container {padding: 12px 6px;margin: 0;}';

		$this->assertEquals($minified, (new phpmnfy)->compress($formatted));
	}
}