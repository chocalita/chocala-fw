<?php

namespace Chocala\Behavior;

/**
 *
 * User: Yecid
 * Date: 3/4/2016
 * Time: 11:53 p.m.
 */
interface SoftDeletion
{

//    public static function create($modelAlias = null, Criteria $criteria = null);
    public static function create($modelAlias = null, \Propel\Runtime\ActiveQuery\Criteria $criteria = null);

    public function filterByStatus($status = null, $comparison = null);

    public static function createQuery($modelAlias = null, Criteria $criteria = null);

    public function filterValids();

    public static function createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null);

    public function orders($orderByArray);

}