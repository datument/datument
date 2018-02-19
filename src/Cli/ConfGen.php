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
		$path= PROJECT_DIR.$this->option( 'config' );

		if( file_exists( $path ) )
		if(!( $this->confirm( 'config file is already exists, would you override it?' ) ))
			return 1;

		file_put_contents( $path, file_get_contents( __DIR__.'/../../stubs/.datument' ) );

		return 0;
	}

}
