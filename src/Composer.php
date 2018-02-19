<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

final class Composer
{

	/**
	 * Composer post-package-install script.
	 *
	 * @static
	 * @access public
	 *
	 * @return void
	 */
	static public function postInstall():void
	{
		Config::init();
	}

	/**
	 * Composer post-package-update script.
	 *
	 * @static
	 * @access public
	 *
	 * @return void
	 */
	static public function postUpdate():void
	{
		Config::update();
	}

}
