<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Business\Writer;

use Generated\Shared\Transfer\RoleTransfer;
use Spryker\Zed\Acl\Business\Writer\RoleWriter as SprykerRoleWriter;
use Spryker\Zed\Acl\Persistence\AclEntityManagerInterface;
use Spryker\Zed\Acl\Persistence\AclRepositoryInterface;

class RoleWriter extends SprykerRoleWriter
{
    /**
     * @var \Xiphias\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface
     */
    protected $bfxRoleWriter;

    /**
     * @param \Spryker\Zed\Acl\Persistence\AclEntityManagerInterface $aclEntityManager
     * @param \Spryker\Zed\Acl\Persistence\AclRepositoryInterface $aclRepository
     * @param array $aclRolePostSavePlugins
     * @param \Xiphias\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface $bfxRoleWriter
     */
    public function __construct(
        AclEntityManagerInterface $aclEntityManager,
        AclRepositoryInterface $aclRepository,
        array $aclRolePostSavePlugins,
        BladeFxRoleWriterInterface $bfxRoleWriter,
    ) {
        parent::__construct($aclEntityManager, $aclRepository, $aclRolePostSavePlugins);
        $this->bfxRoleWriter = $bfxRoleWriter;
    }

    /**
     * @param \Generated\Shared\Transfer\RoleTransfer $roleTransfer
     *
     * @return \Generated\Shared\Transfer\RoleTransfer
     */
    public function createRole(RoleTransfer $roleTransfer): RoleTransfer
    {
        $createdRoleTransfer = parent::createRole($roleTransfer);
        $this->bfxRoleWriter->writeBladeFxRole($roleTransfer);

        return $createdRoleTransfer;
    }
}
