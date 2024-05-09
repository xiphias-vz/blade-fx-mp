<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi;

use GuzzleHttp\ClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Xiphias\Client\ReportsApi\Handler\ApiHandler;
use Xiphias\Client\ReportsApi\Handler\ApiHandlerInterface;
use Xiphias\Client\ReportsApi\Http\Client\HttpApiClient;
use Xiphias\Client\ReportsApi\Http\Client\HttpApiClientInterface;
use Xiphias\Client\ReportsApi\Request\RequestFactory;
use Xiphias\Client\ReportsApi\Request\RequestFactoryInterface;
use Xiphias\Client\ReportsApi\Request\RequestManager;
use Xiphias\Client\ReportsApi\Request\RequestManagerInterface;
use Xiphias\Client\ReportsApi\Response\ResponseFactory;
use Xiphias\Client\ReportsApi\Response\ResponseFactoryInterface;
use Xiphias\Client\ReportsApi\Response\ResponseManager;
use Xiphias\Client\ReportsApi\Response\ResponseManagerInterface;

/**
 * @method \Xiphias\Client\ReportsApi\ReportsApiConfig getConfig()
 */
class ReportsApiFactory extends AbstractFactory
{
    /**
     * @return \Xiphias\Client\ReportsApi\Handler\ApiHandlerInterface
     */
    public function createApiHandler(): ApiHandlerInterface
    {
        return new ApiHandler(
            $this->createRequestManager(),
            $this->createResponseManager(),
            $this->createHttpApiClient(),
            $this->getConfig(),
            $this->createRequestFactory(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\RequestManagerInterface
     */
    private function createRequestManager(): RequestManagerInterface
    {
        return new RequestManager(
            $this->createRequestFactory(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\ResponseManagerInterface
     */
    public function createResponseManager(): ResponseManagerInterface
    {
        return new ResponseManager($this->createResponseFactory());
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\RequestFactoryInterface
     */
    private function createRequestFactory(): RequestFactoryInterface
    {
        return new RequestFactory();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\ResponseFactoryInterface
     */
    private function createResponseFactory(): ResponseFactoryInterface
    {
        return new ResponseFactory(
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): UtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::UTIL_ENCODING_SERVICE);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Http\Client\HttpApiClientInterface
     */
    private function createHttpApiClient(): HttpApiClientInterface
    {
        return new HttpApiClient($this->getHttpClient());
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    private function getHttpClient(): ClientInterface
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::CLIENT_HTTP);
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    protected function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::SESSION_CLIENT);
    }
}
