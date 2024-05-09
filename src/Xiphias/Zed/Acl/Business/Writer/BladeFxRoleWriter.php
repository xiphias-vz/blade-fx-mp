<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Business\Writer;

use Generated\Shared\Transfer\RoleTransfer;
use Xiphias\Zed\Acl\Persistence\AclQueryContainerInterface;

class BladeFxRoleWriter implements BladeFxRoleWriterInterface
{
    /**
     * @var \Xiphias\Zed\Acl\Persistence\AclQueryContainerInterface
     */
    protected $aclQueryContainer;

    /**
     * @param \Xiphias\Zed\Acl\Persistence\AclQueryContainerInterface $aclQueryContainer
     */
    public function __construct(AclQueryContainerInterface $aclQueryContainer)
    {
        $this->aclQueryContainer = $aclQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\RoleTransfer $roleTransfer
     *
     * @return void
     */
    public function writeBladeFxRole(RoleTransfer $roleTransfer): void
    {
        $roleTransfer->requireIdAclRole();

        $bfxRoleEntity = $this->aclQueryContainer
            ->queryBfxRoleByIdRole($roleTransfer->getIdAclRole())
            ->findOneOrCreate();

        $bfxRoleEntity->fromArray($roleTransfer->toArray());
        $bfxRoleEntity->setFkAclRole($roleTransfer->getIdAclRole());

        $bfxRoleEntity->save();
    }
}
