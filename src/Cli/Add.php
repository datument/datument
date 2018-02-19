<?php

declare( strict_types= 1 );

namespace Datument\Cli;

////////////////////////////////////////////////////////////////

class Add extends ACommand
{

	/**
	 * Static method run
	 *
	 * @access public
	 *
	 * @return int
	 */
	public function run():int
	{
		[ $namespace, $additions, ]= $this->params()->firstOthers();

		foreach( $additions as $addition )

			$this->add( $addition );
	}

	/**
	 * Method add
	 *
	 * @access private
	 *
	 * @param  string $addition
	 *
	 * @return void
	 */
	private function add( string$addition )
	{
		// TODO find file
		$file= $addition;
	}

}
