<?php

use Propel\Runtime\Map\TableMap;

/**
 * @author: ypra
 * Date: 2/8/2016
 * Time: 10:47 p.m.
 */
trait Relatable
{

    /**
     * @return TableMap
     */
    public function tableMap(): TableMap
    {
        $tableMapClass = self::TABLE_MAP;
        return $tableMapClass::getTableMap();
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationMaps(): array
    {
        return $this->tableMap()->getRelations();
    }

    /**
     * @param int $type
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    private function relationsFilter($type) : array
    {
        return array_filter($this->relationMaps(), function($relation) use ($type){
            return $relation->getType() == $type;
        });
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsManyToOne() : array
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::MANY_TO_ONE);
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsOneToMany() : array
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::ONE_TO_MANY);
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsOneToOne() : array
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::ONE_TO_ONE);
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsManyToMany() : array
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::MANY_TO_MANY);
    }

}