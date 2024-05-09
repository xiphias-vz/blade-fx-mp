<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Builder;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;

class AuthenticationRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var array<\Xiphias\Client\ReportsApi\Plugins\Formatter\AuthenticationRequestFieldFormatterPlugin>
     */
    protected array $fieldFormatterPlugins;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $apiClientConfig
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface $bodyFormatter
     * @param array $fieldFormatterPlugins
     */
    public function __construct(
        ReportsApiConfig $apiClientConfig,
        UtilEncodingServiceInterface $utilEncodingService,
        RequestBodyFormatterInterface $bodyFormatter,
        array $fieldFormatterPlugins,
    ) {
        parent::__construct($apiClientConfig, $utilEncodingService, $bodyFormatter);

        $this->fieldFormatterPlugins = $fieldFormatterPlugins;
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
        return [];
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return string
     */
    protected function getEncodedData(AbstractTransfer $requestTransfer): string
    {
        $data = $requestTransfer->toArray(true, true);

        $this->executeFormatterPlugins($data);

        return $this->utilEncodingService->encodeJson($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function executeFormatterPlugins(array $data): array
    {
        foreach ($this->fieldFormatterPlugins as $fieldFormatterPlugin) {
            $data = $fieldFormatterPlugin->format($data);
        }

        return $data;
    }
}
