<?php
namespace Phpmnfy;

class Runner 
{
	public function compress($input)
	{
		$output = Strip::newlines($input);
		$output = Strip::tabs($output);
		return $output;
	}
}