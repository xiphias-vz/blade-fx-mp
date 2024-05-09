<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\Authenticator;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxAuthenticator implements BladeFxAuthenticatorInterface
{
    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var array<\Xiphias\Zed\Reports\Communication\Plugins\Authentication\BladeFxPostAuthenticationPluginInterface>
     */
    protected array $bladeFxPostAuthenticationPlugins;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param array $bladeFxPostAuthenticationPlugins
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        ReportsConfig $config,
        SessionClientInterface $sessionClient,
        array $bladeFxPostAuthenticationPlugins,
    ) {
        $this->apiClient = $apiClient;
        $this->config = $config;
        $this->sessionClient = $sessionClient;
        $this->bladeFxPostAuthenticationPlugins = $bladeFxPostAuthenticationPlugins;
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function authenticate(): BladeFxAuthenticationResponseTransfer
    {
        $authenticationResponseTransfer = $this->apiClient->sendAuthenticateUserRequest(
            $this->getAuthenticationRequestTransfer(),
        );

        $this->executePostAuthenticationPlugins($authenticationResponseTransfer);

        return $authenticationResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer
     *
     * @return void
     */
    protected function executePostAuthenticationPlugins(BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer): void
    {
        foreach ($this->bladeFxPostAuthenticationPlugins as $bladeFxPostAuthenticationPlugin) {
            $bladeFxPostAuthenticationPlugin->execute($authenticationResponseTransfer);
        }
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer
     */
    protected function getAuthenticationRequestTransfer(): BladeFxAuthenticationRequestTransfer
    {
        return (new BladeFxAuthenticationRequestTransfer())
            ->setUsername($this->config->getDefaultUsername())
            ->setPassword($this->config->getDefaultPassword())
            ->setLicenceExp($this->config->getDefaultLicenceExp());
    }
}
