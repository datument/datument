<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

final class Config
{

	/**
	 * Initiate the configurations.
	 *
	 * @static
	 * @access public
	 *
	 * @return void
	 */
	static public function init():void
	{
		$var= PathManager::getVarPath();
		$stub= PathManager::getStubPath();

		copy( "$stub/config", "$var/config" );
	}

	/**
	 * Update the configurations to follow package version.
	 *
	 * @static
	 * @access public
	 *
	 * @return void
	 */
	static public function update():viod
	{
		// DEV
		init();
	}

}
