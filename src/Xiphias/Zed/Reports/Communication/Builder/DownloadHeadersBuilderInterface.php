<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Builder;

interface DownloadHeadersBuilderInterface
{
    /**
     * @param string $fileFormat
     *
     * @return array
     */
    public function buildDownloadHeaders(string $fileFormat): array;
}
