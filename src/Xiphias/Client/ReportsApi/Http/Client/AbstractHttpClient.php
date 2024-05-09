<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Http\Client;

use GuzzleHttp\ClientInterface;
use Spryker\Shared\Log\LoggerTrait;

abstract class AbstractHttpClient implements HttpApiClientInterface
{
    use LoggerTrait;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
