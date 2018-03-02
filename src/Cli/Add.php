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
	 * @param  IArgs $args
	 *
	 * @return int
	 * @throws \Throwable
	 */
	public function main( IArgs$args ):int
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
