<?php

declare( strict_types= 1 );

namespace Datument;

////////////////////////////////////////////////////////////////

interface IStorage
{

	/**
	 * Method query
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @param  Query $query
	 *
	 * @return ResultSet
	 */
	function query( Querier\Query$query ):ResultSet;

}
