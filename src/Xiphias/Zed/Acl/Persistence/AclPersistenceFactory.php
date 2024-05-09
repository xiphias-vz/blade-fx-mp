<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Persistence;

use Orm\Zed\Acl\Persistence\PyzBfxRoleQuery;
use Spryker\Zed\Acl\Persistence\AclPersistenceFactory as SprykerAclPersistenceFactory;

/**
 * @method \Spryker\Zed\Acl\Persistence\AclRepositoryInterface getRepository()
 * @method \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Acl\Persistence\AclEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Acl\AclConfig getConfig()
 */
class AclPersistenceFactory extends SprykerAclPersistenceFactory
{
    /**
     * @return \Orm\Zed\Acl\Persistence\PyzBfxRoleQuery
     */
    public function createBfxRoleQuery(): PyzBfxRoleQuery
    {
        return PyzBfxRoleQuery::create();
    }
}
