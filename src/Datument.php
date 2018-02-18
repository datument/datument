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

	/**
	 * Static method registerStorage
	 *
	 * @static
	 * @access public
	 *
	 * @param  string $name
	 * @param  IStorage $storage
	 *
	 * @return void
	 */
	static public function registerStorage( string$name, IStorage$storage ):viod
	{
		if( isset( self::$storages[$name] ) )
			throw new \Exception();

		self::$storages[$name]= $storage;
	}

	/**
	 * Static method getStorage
	 *
	 * @static
	 * @access public
	 *
	 * @param  mixed $name
	 *
	 * @return IStorage
	 */
	static public function getStorage( $name ):IStorage
	{
		if(!(  isset( self::$storages[$name] ) ) )
			throw new \Exception();

		return self::$storages[$name];
	}

	/**
	 * Var storages
	 *
	 * @static
	 * @access protected
	 *
	 * @var    array
	 */
	static protected $storages= [];

}
