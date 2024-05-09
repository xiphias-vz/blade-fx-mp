<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Business;

use Generated\Shared\Transfer\RoleTransfer;
use Spryker\Zed\Acl\Business\AclFacade as SprykerAclFacade;

/**
 * @method \Xiphias\Zed\Acl\Business\AclBusinessFactory getFactory()
 * @method \Spryker\Zed\Acl\Persistence\AclRepositoryInterface getRepository()
 * @method \Spryker\Zed\Acl\Persistence\AclEntityManagerInterface getEntityManager()
 */
class AclFacade extends SprykerAclFacade implements AclFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RoleTransfer $roleTransfer
     *
     * @return void
     */
    public function writeBladeFxRole(RoleTransfer $roleTransfer): void
    {
        $this->getFactory()
            ->createBladeFxRoleWriter()
            ->writeBladeFxRole($roleTransfer);
    }
}
