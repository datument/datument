<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

abstract class AModel
{

	/**
	 * Method __callStatic
	 *
	 * @static
	 * @access public
	 * @final
	 *
	 * @param  string $method
	 * @param  array $args
	 *
	 * @return mixed
	 */
	static public final function __callStatic( string$method, array$args )
	{
		return Querier::from( static::class )::$method( ...$args );
	}

	/**
	 * Static method isTimeColumn
	 *
	 * @static
	 * @access public
	 *
	 * @param  string $column
	 *
	 * @return bool
	 */
	static public function isTimeColumn( string$column ):bool
	{
		#
	}

}
