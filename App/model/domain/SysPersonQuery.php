<?php

use Base\SysPersonQuery as BaseSysPersonQuery;

/**
 * @author ypra
 *
 * @method static SysPersonQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysPersonQuery filterValids()
 */
class SysPersonQuery extends BaseSysPersonQuery //implements SoftDeletion
{
    use SoftQuery;

    /**
     * @return $this|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function withCompleteName()
    {
        return $this->withColumn('CONCAT(SysPerson.FirstName, " ", SysPerson.MiddleName, " ", '.
            'SysPerson.LastName, " ", SysPerson.SecondLastName)', 'CompleteName');
    }

    /**
     * @param string $order
     * @return $this|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function orderByCompleteName($order = Criteria::ASC)
    {
        return $this->withCompleteName()->orderBy("CompleteName", $order);

    }

    /**
     * @return $this|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function withFormalName()
    {
        return $this->withColumn('CONCAT(SysPerson.LastName, " ", SysPerson.SecondLastName, " ", '.
            'SysPerson.FirstName, " ", SysPerson.MiddleName)', 'FormalName');
    }

    /**
     * @param string $order
     * @return $this|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function orderByFormalName($order = Criteria::ASC)
    {
        return $this->withFormalName()->orderBy("FormalName", $order);
    }

    /**
     * @param SysUser $user
     * @param bool|true $noDeletes
     * @return SysPerson
     */
    public static function findByUser(SysUser $user, $noDeletes=true)
    {
        return self::createValids($noDeletes)->findOneByUserId($user->getId());
    }

}
