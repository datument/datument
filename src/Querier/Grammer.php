<?php

declare( strict_types= 1 );

namespace Datument\Querier;

////////////////////////////////////////////////////////////////

class Grammer
{

	/**
	 * Static method parseColumn
	 *
	 * @static
	 * @access public
	 *
	 * @param  string $column
	 *
	 * @return array
	 */
	static public function parseColumn( string$column ):array
	{
		if(!( is_int( strpos( $column ) ) ))
		{
			return [ 'type'=>'column', 'column'=>$column, ];
		}

		$processors= explode( ':', $string );

		$column= array_pop( $processors );

		return [ 'type'=>'processed', 'processors'=>$processors, 'column'=>$column, ];
	}

	/**
	 * Static method parseOperator
	 *
	 * @static
	 * @access public
	 *
	 * @param  string $operator
	 *
	 * @return array
	 */
	static public function parseOperator( string$operator ):array
	{
		$simple= '@'!==substr( $operator, -1 );
		$not= '!'===substr( $operator, 0, 1 );

		$etymon= substr( $operator, (int)$not, ...($simple? [] : [ -1, ]) );

		return [
			'operator'=> [ 'not'=>$not, 'operator'=>$etymon, ],
			'simple'=> $simple,
		];
	}

}
