<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Persistence;

use Orm\Zed\Acl\Persistence\Map\PyzBfxRoleTableMap;
use Orm\Zed\Acl\Persistence\PyzBfxRoleQuery;
use Orm\Zed\Acl\Persistence\SpyAclRoleQuery;
use Spryker\Zed\Acl\Persistence\AclQueryContainer as SprykerAclQueryContainer;
use Xiphias\Zed\Acl\Persistence\Propel\Formatter\TypedOnDemandFormatter;

/**
 * @method \Xiphias\Zed\Acl\Persistence\AclPersistenceFactory getFactory()
 */
class AclQueryContainer extends SprykerAclQueryContainer implements AclQueryContainerInterface
{
    /**
     * @param int $id
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery
     */
    public function queryRoleByIdForDelete(int $id): SpyAclRoleQuery
    {
        $query = $this->getFactory()->createRoleQuery();

        $query->filterByIdAclRole($id);

        return $query;
    }

    /**
     * @param int $id
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery
     */
    public function queryRoleById($id): SpyAclRoleQuery
    {
        $query = parent::queryRoleById($id);

        $query->setFormatter(new TypedOnDemandFormatter())
            ->innerJoinPyzBfxRole()
            ->withColumn(PyzBfxRoleTableMap::COL_IS_BFX_ROLE, 'is_bfx_role')
            ->withColumn(PyzBfxRoleTableMap::COL_BFX_ROLE_KEY, 'bfx_role_key');

        return $query;
    }

    /**
     * @param int $idRole
     *
     * @return \Orm\Zed\Acl\Persistence\PyzBfxRoleQuery
     */
    public function queryBfxRoleByIdRole(int $idRole): PyzBfxRoleQuery
    {
        $query = $this->getFactory()->createBfxRoleQuery();
        $query->filterByFkAclRole($idRole);

        return $query;
    }
}
