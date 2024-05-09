<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class CategoriesListRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    public function getRequestTransferClass(): string
    {
        return BladeFxGetCategoriesListRequestTransfer::class;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return bool
     */
    public function validateRequest(AbstractTransfer $requestTransfer): bool
    {
        try {
            $requestTransfer
                ->requireToken()
                ->requireReturnType();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
