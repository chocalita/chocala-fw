<?php

/**
 * @author: ypra
 * Date: 2/8/2016
 * Time: 10:47 p.m.
 */
trait Relatable
{

    /**
     * @return \Propel\Runtime\Map\TableMap
     */
    public function tableMap()
    {
        $tableMapClass = self::TABLE_MAP;
        return $tableMapClass::getTableMap();
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationMaps()
    {
        return $this->tableMap()->getRelations();
    }

    /**
     * @param int $type
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    private function relationsFilter($type)
    {
        return array_filter($this->relationMaps(), function($relation) use ($type){
            return $relation->getType() == $type;
        });
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsManyToOne()
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::MANY_TO_ONE);
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsOneToMany()
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::ONE_TO_MANY);
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsOneToOne()
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::ONE_TO_ONE);
    }

    /**
     * @return \Propel\Runtime\Map\RelationMap[]
     */
    public function relationsManyToMany()
    {
        return $this->relationsFilter(\Propel\Runtime\Map\RelationMap::MANY_TO_MANY);
    }

}