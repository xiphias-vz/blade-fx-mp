<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportsReader;

use Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Generated\Shared\Transfer\ReportsReaderRequestTransfer;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsReader implements ReportsReaderInterface
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
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsList(ReportsReaderRequestTransfer $readerRequestTransfer, ?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        $requestTransfer = $this->buildAuthenticatedGetReportsListRequest($readerRequestTransfer, $attribute);

        return $this->apiClient->sendGetReportsListRequest($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer
     */
    public function buildAuthenticatedGetReportsListRequest(
        ReportsReaderRequestTransfer $readerRequestTransfer,
        ?string $attribute = '',
    ): BladeFxGetReportsListRequestTransfer {
        return (new BladeFxGetReportsListRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setToken($this->tokenResolver->resolveToken()))
            ->setCatId($readerRequestTransfer->getActiveCategory() ?? $this->config->getDefaultCategoryIndex())
            ->setAttribute($attribute)
            ->setReturnType($this->config->getReturnTypeJson());
    }

    /**
     * @param int $reportId
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer
    {
        $requestTransfer = (new BladeFxGetReportParamFormRequestTransfer())
            ->setRootUrl($this->config->getParamFormRootUrl())
            ->setReportId($reportId)
            ->setToken((new BladeFxTokenTransfer())->setToken($this->tokenResolver->resolveToken()));

        return $this->apiClient->sendGetReportParamFormRequest($requestTransfer);
    }
}
