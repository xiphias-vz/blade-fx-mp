<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface RequestValidatorInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    public function isRequestValid(AbstractTransfer $requestTransfer): bool;
}
