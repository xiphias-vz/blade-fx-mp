<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Builder;

use GuzzleHttp\Psr7\Request;
use league\ReportsConstants;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;

class ReportPreviewRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface
     */
    protected RequestBodyFormatterInterface $bodyFormatter;

    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiConfig
     */
    protected ReportsApiConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface $bodyFormatter
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $config
     */
    public function __construct(RequestBodyFormatterInterface $bodyFormatter, UtilEncodingServiceInterface $utilEncodingService, ReportsApiConfig $config)
    {
        parent::__construct($config, $utilEncodingService, $bodyFormatter);

        $this->bodyFormatter = $bodyFormatter;
        $this->utilEncodingService = $utilEncodingService;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return parent::METHOD_POST;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function getAdditionalHeaders(AbstractTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $reportPreviewRequestTransfer */
        $reportPreviewRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($reportPreviewRequestTransfer->getToken());
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        AbstractTransfer $requestTransfer,
    ): RequestInterface {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $reportPreviewRequestTransfer */
        $reportPreviewRequestTransfer = $requestTransfer;

        $uri = $this->buildUri(
            $resource,
            [ReportsConstants::ROOT_URL_QUERY_PROPERTY => $reportPreviewRequestTransfer->getRootUrl()],
        );
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return string
     */
    protected function getEncodedData(AbstractTransfer $requestTransfer): string
    {
        $data = $this->bodyFormatter->formatDataBeforeEncoding(
            $requestTransfer,
        );

        return $this->utilEncodingService->encodeJson($data);
    }
}
