<?php

declare( strict_types= 1 );

namespace Datument;

use Fenzland\CLI as FCLI;

////////////////////////////////////////////////////////////////

class Cli
{

	/**
	 * Run cli command.
	 *
	 * @static
	 * @access public
	 *
	 * @param  int $argc
	 * @param  array $argv
	 *
	 * @return int
	 */
	static public function run( int$argc, array$argv ):int
	{
		return static::makeApp()->run( $argc, $argv );
	}

	/**
	 * Commands
	 *
	 * @static
	 * @access protected
	 *
	 * @var    array
	 */
	static protected $commands= [
		'confgen'=>  Cli\ConfigGenerate::class,
		'diff'=>     Cli\Diff::class,
		'migrate'=>  Cli\Migrate::class,
		'add'=>      Cli\Add::class,
		'remove'=>   Cli\Remove::class,
		'relate'=>   Cli\Relate::class,
		'unrelate'=> Cli\UnRelate::class,
	];

	/**
	 * Make a cli application.
	 *
	 * @static
	 * @access protected
	 *
	 * @return FCLI\App
	 */
	static protected function makeApp():FCLI\App
	{
		$app= new FCLI\App;

		foreach( static::$commands as $command=>$class )
		{
			$app->regCmd( $command, $class );
		}

		return $app;
	}

}
