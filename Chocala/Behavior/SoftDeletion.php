<?php

use Propel\Runtime\ActiveQuery\Criteria;

/**
 *
 * User: Yecid
 * Date: 3/4/2016
 * Time: 11:53 p.m.
 */
interface  SoftDeletion
{

    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria;

    public function filterByStatus($status = null, ?string $comparison = null);

    public static function createQuery($modelAlias = null, ?Criteria $criteria = null);

    public function filterValids();

    public static function createValids($noDeletes = true, $modelAlias = null, ?Criteria $criteria = null);

    public function orders($orderByArray);

}