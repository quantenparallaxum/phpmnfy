<?php
namespace Phpmnfy;

class Runner 
{
	public $files; 

	public function __construct($configurationFile = null)
	{
		if (is_null($configurationFile)) return; 

		$configuration = json_decode(
			file_get_contents($configurationFile),
			true
		);

		if (!is_array($configuration)) return; 

		if (array_key_exists('files', $configuration)) 
			$this->files = $configuration['files'];
	}

	public function compress($input)
	{
		$output = Strip::newlines($input);
		$output = Strip::tabs($output);
		return $output;
	}
}