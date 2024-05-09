<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Xiphias\Client\ReportsApi\Plugins\Formatter\AuthenticationRequestFieldFormatterPlugin;

/**
 * @method \Xiphias\Client\ReportsApi\ReportsApiConfig getConfig()
 */
class ReportsApiDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_HTTP = 'CLIENT_HTTP';

    /**
     * @var string
     */
    public const UTIL_ENCODING_SERVICE = 'UTIL_ENCODING_SERVICE';

    /**
     * @var string
     */
    public const SESSION_CLIENT = 'SESSION_CLIENT';

    /**
     * @var string
     */
    public const AUTHENTICATION_REQUEST_FORMATTER_PLUGINS = 'AUTHENTICATION_REQUEST_FORMATTER_PLUGINS';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $this->addHttpClient($container);
        $this->addUtilEncodingService($container);
        $this->addSessionClient($container);
        $this->addFormatterPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addHttpClient(Container $container): void
    {
        $commonConfig = $this->getConfig()->getCommonHttpClientConfig();
        $container->set(
            static::CLIENT_HTTP,
            static function () use ($commonConfig): ClientInterface {
                return new Client($commonConfig);
            },
        );
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addUtilEncodingService(Container $container): void
    {
        $container->set(
            static::UTIL_ENCODING_SERVICE,
            static function (Container $container): UtilEncodingServiceInterface {
                return $container->getLocator()->utilEncoding()->service();
            },
        );
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addSessionClient(Container $container): void
    {
        $container->set(
            static::SESSION_CLIENT,
            static function (Container $container): SessionClientInterface {
                return $container->getLocator()->session()->client();
            },
        );
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function addFormatterPlugins(Container $container): Container
    {
        $container->set(static::AUTHENTICATION_REQUEST_FORMATTER_PLUGINS, function (Container $container) {
            return $this->getFormatterPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Xiphias\Client\ReportsApi\Plugins\Formatter\AuthenticationRequestFieldFormatterPlugin>
     */
    protected function getFormatterPlugins(): array
    {
        return [
            new AuthenticationRequestFieldFormatterPlugin(),
        ];
    }
}
