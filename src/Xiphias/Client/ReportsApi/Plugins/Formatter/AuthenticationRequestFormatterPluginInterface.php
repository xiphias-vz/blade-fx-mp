<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Plugins\Formatter;

interface AuthenticationRequestFormatterPluginInterface
{
    /**
     * @param array $requestData
     *
     * @return array
     */
    public function format(array $requestData): array;
}
