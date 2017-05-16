<?php

use PHPUnit\Framework\TestCase; 
use Phpmnfy\Runner as phpmnfy;
use org\bovigo\vfs\vfsStream;

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

	public function testCliRunnerWithConfiguration()
	{
		$directory = [
			'mnfy.json' => '{"files": ["assets/styles.css"]}',
			'assets' => [
				'style.css' => 'html {
					padding: 12px 6px;
					margin: 0;
				}

				.foo {
					color: red;
				}'
			]
		];

		$filesystem = vfsStream::setup('root', 444, $directory);
		$configurationFile = $filesystem->url() . '/mnfy.json';
		
		$minifier = new Phpmnfy();
		$minifier->asset('static/css/style.css')->to('dist/assets/css/style.css');
		$minifier->asset('static/js/main.js')->to('dist/assets/js/main.js');
		// alternatively
		$minifier->css('static/css/styles.css', 'dist/assets/css/style.css')->js('static/js/main.js', 'dist/assets/js/main.js');
		$minifier->run();

		$this->assertEquals(['assets/styles.css'], $minifier->files);
	}
}