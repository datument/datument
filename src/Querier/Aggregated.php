<?php

declare( strict_types= 1 );

namespace Datument\Querier;

////////////////////////////////////////////////////////////////

class Aggregated extends \Datument\Querier
{

	/**
	 * Constructor
	 *
	 * @access public
	 *
	 * @param  string ...$columns
	 */
	public function __construct( string...$columns )
	{
		$this->columns= array_map( [ Grammer::class, 'parseColumn', ], $columns );
		$this->havings= new Querier\ConditionSet;
	}

	/**
	 * Method having
	 *
	 * @access public
	 *
	 * @param  string $column
	 * @param  mixed $second
	 * @param  mixed $third
	 *
	 * @return self
	 */
	public function having( string$column, $second, $third=null ):self
	{
		$this->havings->add( $column, $second, $third );

		return $this;
	}

	/**
	 * Method havingX
	 *
	 * @access public
	 *
	 * @return self
	 */
	public function havingX():self
	{
		#
	}

	/**
	 * Method count
	 *
	 * @access public
	 *
	 * @return int
	 */
	public function count():int
	{
		#
	}

	/**
	 * Method sum
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function sum()
	{
		#
	}

	/**
	 * Method avg
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function avg()
	{
		#
	}

	/**
	 * Method max
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function max()
	{
		#
	}

	/**
	 * Method min
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function min()
	{
		#
	}

	/**
	 * Method implode
	 *
	 * @access public
	 *
	 * @param  string $glue
	 *
	 * @return string
	 */
	public function implode( string$glue ):string
	{
		#
	}

	/**
	 * Var columns
	 *
	 * @access protected
	 *
	 * @var    array
	 */
	protected $columns;

	/**
	 * Var havings
	 *
	 * @access protected
	 *
	 * @var    ConditionSet
	 */
	protected $havings;

}
