<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\CategoryReader;

use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Generated\Shared\Transfer\CategoryReaderRequestTransfer;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxCategoryReader implements BladeFxCategoryReaderInterface
{
    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        TokenResolverInterface $tokenResolver,
        ReportsConfig $config,
    ) {
        $this->apiClient = $apiClient;
        $this->tokenResolver = $tokenResolver;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function getAllCategories(CategoryReaderRequestTransfer $readerRequestTransfer): BladeFxCategoriesListResponseTransfer
    {
        $categories = $this->apiClient->sendGetCategoriesListRequest(
            $this->buildAuthenticatedCategoriesListRequestTransfer($readerRequestTransfer),
        );

        $categoryList = $categories->getCategoriesList();

        foreach ($categoryList as $category) {
            if ($category->getCatId() == $readerRequestTransfer->getActiveCategory()) {
                $category->setIsActiveTree(true);
            }
        }

        $categories->setCategoriesList($categoryList);

        return $categories;
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer
     */
    protected function buildAuthenticatedCategoriesListRequestTransfer(
        CategoryReaderRequestTransfer $readerRequestTransfer,
    ): BladeFxGetCategoriesListRequestTransfer {
        return (new BladeFxGetCategoriesListRequestTransfer())
            ->setCatId($readerRequestTransfer->getActiveCategory() ?? $this->config->getDefaultCategoryIndex())
            ->setReturnType($this->config->getReturnTypeJson())
            ->setToken(
                (new BladeFxTokenTransfer())->setToken($this->tokenResolver->resolveToken()),
            );
    }
}
