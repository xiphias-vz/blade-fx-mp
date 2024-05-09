<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Http\Client;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Xiphias\Client\ReportsApi\ReportsApiConfig;

class HttpApiClient extends AbstractHttpClient
{
    /**
     * @var string
     */
    private const ERROR_API_REQUEST_FAILED = '%s BladeFx API request failed! %s';

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest(RequestInterface $request, array $options = []): ResponseInterface
    {
        try {
            return $this->client->send($request, $options);
        } catch (Throwable $exception) {
            $this->logException($exception, $request);
        }

        return new Response();
    }

    /**
     * @param \Throwable $exception
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return void
     */
    private function logException(Throwable $exception, RequestInterface $request): void
    {
        $this->getLogger()->critical(
            $this->formatMessage($exception->getMessage()),
            $this->getErrorContext($exception, $request),
        );
    }

    /**
     * @param string $exceptionMessage
     *
     * @return string
     */
    private function formatMessage(string $exceptionMessage): string
    {
        return sprintf(
            self::ERROR_API_REQUEST_FAILED,
            ReportsApiConfig::LOG_MESSAGE_PREFIX,
            $exceptionMessage,
        );
    }

    /**
     * @param \Throwable $exception
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return array
     */
    private function getErrorContext(Throwable $exception, RequestInterface $request): array
    {
        return [
            'exception' => $exception,
            'request_uri' => $request->getUri(),
        ];
    }
}
