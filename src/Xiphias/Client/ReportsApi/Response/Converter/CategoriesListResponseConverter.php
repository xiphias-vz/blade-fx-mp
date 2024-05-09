<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use ArrayObject;
use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxCategoryTransfer;

class CategoriesListResponseConverter extends AbstractResponseConverter
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    public function expandConversionResponseTransfer(
        BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer,
        array $responseData,
    ): BladeFxApiResponseConversionResultTransfer {
        $bladeFxCategoriesListResponseTransfer = new BladeFxCategoriesListResponseTransfer();
        $bladeFxCategoryList = [];
        foreach ($responseData as $category) {
            $bladeFxCategory = new BladeFxCategoryTransfer();
            $bladeFxCategory->fromArray($category);
            $bladeFxCategoryList[] = $bladeFxCategory;
        }

        $bladeFxCategoriesListResponseTransfer->setCategoriesList(new ArrayObject($bladeFxCategoryList));

        return $apiResponseConversionResultTransfer->setBladeFxCategoriesListResponse($bladeFxCategoriesListResponseTransfer);
    }
}
