<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

final class PathManager
{

	/**
	 * Returns var path for Datument.
	 *
	 * @static
	 * @access public
	 *
	 * @return string
	 */
	static public function getVarPath():string
	{
		static $path;

		if(!( $path ))
		{
			$path= dirname( dirname( __DIR__ ) ).'/.var';

			mksdir( $path );
		}

		return $path;
	}

	/**
	 * Returns stub path for Datument.
	 *
	 * @static
	 * @access public
	 *
	 * @return string
	 */
	static public function getStubPath():string
	{
		static $path;

		if(!( $path ))
		{
			$path= dirname( __DIR__ ).'/.stubs';

			mksdir( $path );
		}

		return $path;
	}

}
