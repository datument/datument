<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

class Querier
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
		return (new static)->$method( ...$args );
	}

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct()
	{
		$this->conditions= new Querier\ConditionSet;
	}

	/**
	 * Set queried model.
	 *
	 * @access public
	 *
	 * @param  string $model
	 *
	 * @return self
	 */
	public function from( string$model ):self
	{
		$this->model= Datument::parseModel( $model );

		return $this;
	}

	/**
	 * Set queried fields.
	 *
	 * @access public
	 *
	 * @param  string ...$fields
	 *
	 * @return self
	 */
	public function select( string...$fields ):self
	{
		#
	}

	/**
	 * Set queried fields by excluding.
	 *
	 * @access public
	 *
	 * @param  string ...$fields
	 *
	 * @return self
	 */
	public function selectEx( string...$fields ):self
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
	 * @return self
	 */
	public function where( string$column, $second, $third=null ):self
	{
		$this->conditions->add( $column, $second, $third );

		return $this;
	}

	/**
	 * Add a compleX condition.
	 *
	 * @access public
	 *
	 * @return self
	 */
	public function whereX():self
	{
		# TODO TO DESIGN
		return $this;
	}

	/**
	 * Add nested conditions.
	 *
	 * @access public
	 *
	 * @param  array|callable $conditions
	 * @param  string $operator
	 *
	 * @return self
	 */
	public function nested( $conditions, string$operator='AND' ):self
	{
		$this->conditions->nested( $conditions, $operator );

		return $this;
	}

	/**
	 * Set operators between conditions to OR.
	 *
	 * @access public
	 *
	 * @return self
	 */
	public function or():self
	{
		$this->conditions->or();

		return $this;
	}

	/**
	 * Set operators between conditions to AND.
	 *
	 * @access public
	 *
	 * @return self
	 */
	public function and():self
	{
		$this->conditions->and();

		return $this;
	}

	/**
	 * Set order.
	 *
	 * @access public
	 *
	 * @param  string $column
	 * @param  ?string $orientation
	 *
	 * @return self
	 */
	public function orderBy( string$column, ?string$orientation=null ):self
	{
		$Column= Querier\Grammer::parseColumn( $column );

		if( is_null( $orientation ) )
		{
			if(!( $this->model ))
				throw new \TypeError();

			$orientation= $this->model::isTimeColumn( $Column['column'] )? 'DESC' : 'ASC';
		}
		else
		if(!( in_array( $orientation, [ 'ASC', 'DESC', ] ) ))
			throw new \TypeError();

		if( array_key_exists( $column, $this->orders ) ) unset( $this->orders[$column] );

		$order[$column]= [
			'column'=> $Column,
			'orientation'=> $orientation,
		];

		return $this;
	}

	/**
	 * Set order multiply.
	 *
	 * @access public
	 *
	 * @param  array $orders
	 *
	 * @return self
	 */
	public function orderByM( array$orders ):self
	{
		foreach( array_reverse( $orders ) as $column=>$orientation )
		{
			$this->orderBy( $column, $orientation );
		}

		return $this;
	}

	/**
	 * Set limit.
	 *
	 * @access public
	 *
	 * @param  ?int $limit
	 * @param  ?int $offset
	 *
	 * @return self
	 */
	public function limit( ?int$limit, ?int$offset=null ):self
	{
		$this->limit= $limit;

		is_null( $offset ) or $this->offset= $offset;

		return $this;
	}

	/**
	 * Set offset.
	 *
	 * @access public
	 *
	 * @param  int $offset
	 *
	 * @return self
	 */
	public function offset( int$offset ):self
	{
		if( is_null( $this->limit ) ) throw new \Exception();

		$this->offset= $offset;

		return $this;
	}

	/**
	 * Unset limit and offset.
	 *
	 * @access public
	 *
	 * @return self
	 */
	public function unlimit():self
	{
		return $this->limit( null, 0 );
	}

	/**
	 * Set reading or writing lock.
	 *
	 * @access public
	 *
	 * @param  string $type
	 *
	 * @return self
	 */
	public function lock( string$type ):self
	{
		if(!( in_array( $type, [ 'R', 'W', ] ) ))
			throw new \TypeError();

		$this->lock= $type;

		return $this;
	}

	/**
	 * Aggregate the querier.
	 *
	 * @access public
	 *
	 * @return Querier\Aggregated
	 */
	public function agg():Querier\Aggregated
	{
		return $this->cloneTo( new Querier\Aggregated );
	}

	/**
	 * Method groupBy
	 *
	 * @access public
	 *
	 * @param  string ...$columns
	 *
	 * @return Querier\Aggregated
	 */
	public function groupBy( string...$columns ):Querier\Aggregated
	{
		return $this->cloneTo( new Querier\Aggregated( ...$columns ) );
	}

	/**
	 * Method cloneTo
	 *
	 * @access public
	 *
	 * @param  static $target
	 *
	 * @return static
	 */
	public function cloneTo( self$target ):self
	{
		$target->model=      $this->model;
		$target->conditions= clone $this->conditions;
		$target->orders=     $this->orders;
		$target->limit=      $this->limit;
		$target->offset=     $this->offset;
		$target->lock=       $this->lock;

		return $target;
	}

	/**
	 * Method __clone
	 *
	 * @access public
	 */
	public function __clone()
	{
		$this->conditions= clone $this->conditions;
	}

	/**
	 * Get the first record.
	 *
	 * @access public
	 *
	 * @return IEntity
	 *
	 * @throws #
	 */
	public function first():IEntity
	{
		return $this->nth( 0 );
	}

	/**
	 * Get the first record or null.
	 *
	 * @access public
	 *
	 * @return ?IEntity
	 */
	public function firstOrNull():?IEntity
	{
		return $this->nthOrNull( 0 );
	}

	/**
	 * Get the nth record.
	 *
	 * @access public
	 *
	 * @param  int $num
	 *
	 * @return IEntity
	 *
	 * @throws #
	 */
	public function nth( int$num ):IEntity
	{
		$this->limit( 1, $num );

		#
	}

	/**
	 * Method nthOrNull
	 *
	 * @access public
	 *
	 * @param  int $num
	 *
	 * @return ?IEntity
	 */
	public function nthOrNull( int$num ):?IEntity
	{
		#
	}

	/**
	 * Method list
	 *
	 * @access public
	 *
	 * @return Set
	 */
	public function list():Set
	{
		#
	}

	/**
	 * Method column
	 *
	 * @access public
	 *
	 * @param  string $column
	 *
	 * @return array
	 */
	public function column( string$column ):array
	{
		#
	}

	/**
	 * Method mapping
	 *
	 * @access public
	 *
	 * @param  string $key
	 * @param  string $value
	 *
	 * @return array
	 */
	public function mapping( string$key, string$value ):array
	{
		#
	}

	/**
	 * Var model
	 *
	 * @access protected
	 *
	 * @var    class
	 */
	protected $model;

	/**
	 * Var conditions
	 *
	 * @access protected
	 *
	 * @var    Querier\ConditionSet
	 */
	protected $conditions;

	/**
	 * Var orders
	 *
	 * @access protected
	 *
	 * @var    array
	 */
	protected $orders= [];

	/**
	 * Var limit
	 *
	 * @access protected
	 *
	 * @var    ?string
	 */
	protected $limit;

	/**
	 * Var offset
	 *
	 * @access protected
	 *
	 * @var    int
	 */
	protected $offset= 0;

	/**
	 * Var lock
	 *
	 * @access protected
	 *
	 * @var    ?string
	 */
	protected $lock;

}
