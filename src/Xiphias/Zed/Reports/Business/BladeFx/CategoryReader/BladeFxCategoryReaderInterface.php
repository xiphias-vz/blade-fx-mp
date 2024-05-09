<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\CategoryReader;

use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\CategoryReaderRequestTransfer;

interface BladeFxCategoryReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function getAllCategories(CategoryReaderRequestTransfer $readerRequestTransfer): BladeFxCategoriesListResponseTransfer;
}
