<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

class Datument
{

	/**
	 * Register a model.
	 *
	 * @static
	 * @access public
	 *
	 * @param  class $model
	 *
	 * @return void
	 */
	static public function registerModel( string$model ):viod
	{
		#
	}

	/**
	 * Model name to model class.
	 *
	 * @static
	 * @access public
	 *
	 * @param  string $model
	 *
	 * @return class
	 */
	static public function getModel( string$model ):string
	{
		return $model;
	}

}
