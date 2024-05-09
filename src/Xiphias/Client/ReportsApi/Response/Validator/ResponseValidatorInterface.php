<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface ResponseValidatorInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    public function isResponseValid(AbstractTransfer $responseTransfer): bool;
}
