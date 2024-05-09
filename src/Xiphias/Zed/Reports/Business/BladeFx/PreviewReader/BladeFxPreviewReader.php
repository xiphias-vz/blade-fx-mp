<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\PreviewReader;

use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxPreviewReader implements BladeFxPreviewReaderInterface
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
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportsPreview(BladeFxParameterTransfer $parameterTransfer): BladeFxGetReportPreviewResponseTransfer
    {
        $requestTransfer = $this->buildAuthenticatedGetReportsListRequest($parameterTransfer);

        return $this->apiClient->sendGetReportPreviewRequest($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer
     */
    protected function buildAuthenticatedGetReportsListRequest(
        BladeFxParameterTransfer $parameterTransfer,
    ): BladeFxGetReportPreviewRequestTransfer {
        return (new BladeFxGetReportPreviewRequestTransfer())
            ->setRepId($parameterTransfer->getReportId())
            ->setParams($parameterTransfer)
            ->setRootUrl($this->config->getRootUrl())
            ->setLayoutId($this->config->getDefaultLayout())
            ->setReturnType($this->config->getReturnTypeJson())
            ->setToken((new BladeFxTokenTransfer())->setToken($this->tokenResolver->resolveToken()));
    }
}
