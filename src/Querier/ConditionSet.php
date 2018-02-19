<?php

declare( strict_types= 1 );

namespace Datument\Querier;

////////////////////////////////////////////////////////////////

class ConditionSet
{

	/**
	 * Alias of method add.
	 *
	 * @access public
	 *
	 * @param  string $column
	 * @param  mixed $second
	 * @param  mixed $third
	 *
	 * @return void
	 */
	public function where( string$column, $second, $third=null ):viod
	{
		$this->add( $column, $second, $third );
	}

	/**
	 * Alias of method addX.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function whereX():viod
	{
		#
	}

	/**
	 * Add a condition.
	 *
	 * @access public
	 *
	 * @param  string $column
	 * @param  mixed $second
	 * @param  mixed $third
	 *
	 * @return void
	 */
	public function add( string$column, $second, $third=null ):viod
	{
		if( is_null( $third ) )
		{
			$operator= '=';
			$value= $second;
		}
		else
		{
			$operator= $second;
			$value= $third;
		}

		[ 'operator'=>$operator, 'simple'=>$simple, ]= Grammer::parseOperator( $operator );

		$this->conditions[]= [
			'left'=> Grammer::parseColumn( $column ),
			'operator'=> $operator,
			'right'=> $simple? [ 'type'=>'value', 'value'=>$value, ] : Grammer::parseColumn( $value ),
		];
	}

	/**
	 * Add a compleX condition.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function addX():viod
	{
		#
	}

	/**
	 * Add nested conditions.
	 *
	 * @access public
	 *
	 * @param  array|callable $conditions
	 * @param  string $operator
	 *
	 * @return void
	 */
	public function nested( $conditions, string$operator='AND' ):viod
	{
		if( is_callable( $conditions ) )
		{
			$conditions( $conditionSet= new static );
		}
		else
		if( is_array( $conditions ) )
		{
			$conditionSet= new static;

			$conditionSet->setOperator( $operator );

			foreach( $conditions as $condition )
			{
				if(!( is_array( $condition ) && $condition ))
					throw new \TypeError();

				if( is_array( $condition[0] ) )
					$conditionSet->nested( ...$condition );
				else
					$conditionSet->add( ...$condition );
			}
		}
		else throw new \TypeError();

		$this->conditions[]= [ 'type'=>'nested', 'conditions'=>$conditionSet, ];
	}

	/**
	 * Set operators between conditions to OR.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function or():viod
	{
		$this->setOperator( 'OR' );
	}

	/**
	 * Set operators between conditions to AND.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function and():viod
	{
		$this->setOperator( 'AND' );
	}

	/**
	 * Set operators between conditions.
	 *
	 * @access public
	 *
	 * @param  string $operator
	 *
	 * @return void
	 */
	public function setOperator( string$operator ):viod
	{
		if(!( in_array( $operator, [ 'OR', 'AND', ] ) ))
			throw new \TypeError();

		$this->operator= $operator;
	}

	/**
	 * Conditions in array
	 *
	 * @access protected
	 *
	 * @var    array
	 */
	protected $conditions;

	/**
	 * Operators between conditions
	 *
	 * @access protected
	 *
	 * @var    string
	 */
	protected $operator;

}
