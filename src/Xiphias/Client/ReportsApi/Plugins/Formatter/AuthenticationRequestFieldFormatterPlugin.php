<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Plugins\Formatter;

use Spryker\Client\Kernel\AbstractPlugin;

class AuthenticationRequestFieldFormatterPlugin extends AbstractPlugin implements AuthenticationRequestFormatterPluginInterface
{
 /**
  * @var string
  */
    protected const DEFAULT_DELIMITER = '_';

    /**
     * @var string
     */
    protected const DEFAULT_REGEX = '/(?=[A-Z])/';

    /**
     * @param array $requestData
     *
     * @return array
     */
    public function format(array $requestData): array
    {
        $formattedData = [];

        foreach ($requestData as $requestField => $requestFieldValue) {
            $fieldKey = strtolower(
                implode(
                    static::DEFAULT_DELIMITER,
                    preg_split(static::DEFAULT_REGEX, $requestField),
                ),
            );

            $formattedData[$fieldKey] = $requestFieldValue;
        }

        return $formattedData;
    }
}
