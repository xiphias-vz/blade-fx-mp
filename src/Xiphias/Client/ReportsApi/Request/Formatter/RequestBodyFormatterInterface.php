<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Formatter;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface RequestBodyFormatterInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(AbstractTransfer $requestTransfer): array;
}
