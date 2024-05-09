<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater;

use Generated\Shared\Transfer\ReportsUpdaterRequestTransfer;

interface ReportsUpdaterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReportsUpdaterRequestTransfer $updaterRequestTransfer
     *
     * @return void
     */
    public function updateFavorite(ReportsUpdaterRequestTransfer $updaterRequestTransfer): void;
}
