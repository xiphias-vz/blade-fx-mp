<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Persistence;

use Orm\Zed\Acl\Persistence\PyzBfxRoleQuery;
use Orm\Zed\Acl\Persistence\SpyAclRoleQuery;
use Spryker\Zed\Acl\Persistence\AclQueryContainerInterface as SprykerAclQueryContainerInterface;

interface AclQueryContainerInterface extends SprykerAclQueryContainerInterface
{
    /**
     * @param int $id
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery
     */
    public function queryRoleByIdForDelete(int $id): SpyAclRoleQuery;

    /**
     * @param int $idRole
     *
     * @return \Orm\Zed\Acl\Persistence\PyzBfxRoleQuery
     */
    public function queryBfxRoleByIdRole(int $idRole): PyzBfxRoleQuery;
}
