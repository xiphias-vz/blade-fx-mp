<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Builder;

use Generated\Shared\Transfer\BladeFxTokenTransfer;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;

abstract class AbstractRequestBuilder implements RequestBuilderInterface
{
    /**
     * @var string
     */
    protected const METHOD_POST = 'POST';

    /**
     * @var string
     */
    protected const METHOD_GET = 'GET';

    /**
     * @var string
     */
    protected const HEADER_TYPE_AUTHORIZATION = 'Authorization';

    /**
     * @var string
     */
    protected const AUTHORIZATION_TYPE_BEARER = 'Bearer';

    /**
     * @var string
     */
    private const FULL_URL_PATTERN = '{{baseUri}}{{resource}}/';

    private ReportsApiConfig $apiClientConfig;

    protected UtilEncodingServiceInterface $utilEncodingService;

    protected RequestBodyFormatterInterface $requestBodyFormatter;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $apiClientConfig
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface $requestBodyFormatter
     */
    public function __construct(
        ReportsApiConfig $apiClientConfig,
        UtilEncodingServiceInterface $utilEncodingService,
        RequestBodyFormatterInterface $requestBodyFormatter,
    ) {
        $this->apiClientConfig = $apiClientConfig;
        $this->utilEncodingService = $utilEncodingService;
        $this->requestBodyFormatter = $requestBodyFormatter;
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
        $uri = $this->buildUri($resource, []);
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }

    /**
     * @param string $resource
     * @param array $queryParams
     *
     * @return \GuzzleHttp\Psr7\Uri
     */
    protected function buildUri(string $resource, array $queryParams = []): Uri
    {
        $url = $this->buildFullRequestUrl($resource, $queryParams);

        return new Uri($url);
    }

    /**
     * @param string $resource
     * @param array $queryParams
     *
     * @return string
     */
    private function buildFullRequestUrl(string $resource, array $queryParams = []): string
    {
        $url = strtr(
            self::FULL_URL_PATTERN,
            [
                '{{baseUri}}' => $this->apiClientConfig->getApiBaseUri(),
                '{{resource}}' => $resource,
            ],
        );

        if ($queryParams) {
            $url .= '?' . http_build_query($queryParams);
        }

        return $url;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function getCombinedHeaders(AbstractTransfer $requestTransfer): array
    {
        return array_merge(
            $this->getConfig()->getCommonApiRequestHeaders(),
            $this->getAdditionalHeaders($requestTransfer),
        );
    }

    /**
     * @return string
     */
    abstract protected function getMethodName(): string;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    abstract protected function getAdditionalHeaders(AbstractTransfer $requestTransfer): array;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return string
     */
    protected function getEncodedData(AbstractTransfer $requestTransfer): string
    {
        $data = $requestTransfer->toArray(true, true);

        return $this->utilEncodingService->encodeJson($data);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\ReportsApiConfig
     */
    protected function getConfig(): ReportsApiConfig
    {
        return $this->apiClientConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxTokenTransfer $requestTransfer
     *
     * @return array<string>
     */
    protected function addAuthHeader(BladeFxTokenTransfer $requestTransfer): array
    {
        return [
            static::HEADER_TYPE_AUTHORIZATION => static::AUTHORIZATION_TYPE_BEARER . ' ' . $requestTransfer->getToken(),
        ];
    }
}
