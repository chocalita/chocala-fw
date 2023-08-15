<?php

use Base\SysUserQuery as BaseSysUserQuery;

/**
 *
 * @author ypra
 *
 * @method static SysUserQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysUserQuery filterValids()
 */
class SysUserQuery extends BaseSysUserQuery implements SoftDeletion
{
    use SoftQuery;

    public static function statusMap()
    {
        return SysUser::statusMap();
    }

    /**
     * @return JobCurriculumQuery|SysUserQuery
     */
    public function withCompleteName()
    {
        return $this->useSysPersonQuery()
            ->withCompleteName()
        ->endUse();
    }

    /**
     * @param string $order
     * @return JobCurriculumQuery|SysUserQuery
     */
    public function orderByCompleteName(string $order = Criteria::ASC)
    {
        return $this->useSysPersonQuery()
            ->orderByCompleteName($order)
        ->endUse();
    }

    /**
     * @return JobCurriculumQuery|SysUserQuery
     */
    public function withFormalName()
    {
        return $this->useSysPersonQuery()
            ->withFormalName()
        ->endUse();
    }

    /**
     * @param string $order
     * @return JobCurriculumQuery|SysUserQuery
     */
    public function orderByFormalName(string $order = Criteria::ASC)
    {
        return $this->useSysPersonQuery()
                ->orderByFormalName($order)
            ->endUse();
    }

}