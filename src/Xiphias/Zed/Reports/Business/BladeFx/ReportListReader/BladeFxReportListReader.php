<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportListReader;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxReportListReader implements BladeFxReportListReaderInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_DATA_RETURN_TYPE = 'JSON';

    /**
     * @var int
     */
    protected const DEFAULT_CATEGORY_INDEX = 0;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
     */
    protected BladeFxAuthenticatorInterface $authenticator;

    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface $authenticator
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxAuthenticatorInterface $authenticator,
        ReportsApiClientInterface $apiClient,
        SessionClientInterface $sessionClient,
        ReportsConfig $config,
    ) {
        $this->authenticator = $authenticator;
        $this->apiClient = $apiClient;
        $this->sessionClient = $sessionClient;
        $this->config = $config;
    }

    /**
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportList(?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        return $this->apiClient->sendGetReportsListRequest(
            $this->buildAuthenticatedReportListRequestTransfer($attribute),
        );
    }

    /**
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer
     */
    protected function buildAuthenticatedReportListRequestTransfer(?string $attribute = ''): BladeFxGetReportsListRequestTransfer
    {
        return $this->buildReportListRequestTransfer(
            $this->getUserToken(),
            $attribute,
        );
    }

    /**
     * @return string
     */
    protected function getUserToken(): string
    {
        $bfxTokenSessionKey = $this->config->getBfxTokenSessionKey();

        if ($this->sessionClient->has($bfxTokenSessionKey)) {
            return $this->sessionClient->get($bfxTokenSessionKey);
        }

        return $this->getAuthenticationResponseTransfer()->getToken();
    }

    /**
     * @param string $token
     * @param string $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer
     */
    protected function buildReportListRequestTransfer(
        string $token,
        string $attribute = '',
    ): BladeFxGetReportsListRequestTransfer {
        return (new BladeFxGetReportsListRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setToken($token))
            ->setAttribute($attribute)
            ->setReturnType(static::DEFAULT_DATA_RETURN_TYPE);
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    protected function getAuthenticationResponseTransfer(): BladeFxAuthenticationResponseTransfer
    {
        return $this->authenticator->authenticate();
    }
}
