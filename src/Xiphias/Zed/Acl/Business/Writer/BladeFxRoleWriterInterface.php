<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Business\Writer;

use Generated\Shared\Transfer\RoleTransfer;

interface BladeFxRoleWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RoleTransfer $roleTransfer
     *
     * @return void
     */
    public function writeBladeFxRole(RoleTransfer $roleTransfer): void;
}
