<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Builder;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class ReportParamFormRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var string
     */
    protected const PARAM_ROOT_URL = 'rootUrl';

    /**
     * @var string
     */
    protected const PARAM_REPORT_ID = 'rep_id';

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return parent::METHOD_GET;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function getAdditionalHeaders(AbstractTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $reportParamFormRequestTransfer */
        $reportParamFormRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($reportParamFormRequestTransfer->getToken());
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
        $uri = $this->buildUri($resource, $this->getUrlParamsFromRequestTransfer($requestTransfer));
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    protected function getUrlParamsFromRequestTransfer(AbstractTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $reportParamFormRequestTransfer */
        $reportParamFormRequestTransfer = $requestTransfer;

        return [
            static::PARAM_ROOT_URL => $reportParamFormRequestTransfer->getRootUrl(),
            static::PARAM_REPORT_ID => $reportParamFormRequestTransfer->getReportId(),
        ];
    }
}
