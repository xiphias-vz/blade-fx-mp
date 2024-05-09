<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Builder;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class SetFavoriteReportRequestBuilder extends AbstractRequestBuilder
{
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
        /** @var \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $setFavoriteReportRequestTransfer */
        $setFavoriteReportRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($setFavoriteReportRequestTransfer->getToken());
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|BladeFxSetFavoriteReportRequestTransfer $requestTransfer @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer@param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        AbstractTransfer|BladeFxSetFavoriteReportRequestTransfer $requestTransfer,
        ?BladeFxParameterTransfer $parameterTransfer = null,
    ): RequestInterface {
        $uri = $this->buildUri($resource, $this->getQueryParamsFromRequestTransfer(
            $requestTransfer,
        ));
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return array
     */
    protected function getQueryParamsFromRequestTransfer(AbstractTransfer|BladeFxSetFavoriteReportRequestTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $setFavoriteReportRequestTransfer */
        $setFavoriteReportRequestTransfer = $requestTransfer;

        return [
            'rep_id' => $setFavoriteReportRequestTransfer->getRepId(),
            'user_id' => $setFavoriteReportRequestTransfer->getUserId(),
        ];
    }
}
