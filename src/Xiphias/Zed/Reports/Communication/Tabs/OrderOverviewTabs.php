<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Tabs;

use Generated\Shared\Transfer\TabItemTransfer;
use Generated\Shared\Transfer\TabsViewTransfer;
use Spryker\Zed\Gui\Communication\Tabs\AbstractTabs;

class OrderOverviewTabs extends AbstractTabs
{
    /**
     * @var string
     */
    public const ORDER_NAME = 'order';

    /**
     * @var string
     */
    public const ORDER_TITLE = 'Order Overview';

    /**
     * @var string
     */
    public const REPORT_NAME = 'report';

    /**
     * @var string
     */
    public const REPORT_TITLE = 'Reports';

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return \Generated\Shared\Transfer\TabsViewTransfer
     */
    protected function build(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        $this
            ->addOrderOverviewTab($tabsViewTransfer)
            ->addReportTableTab($tabsViewTransfer);

        $tabsViewTransfer
            ->setIsNavigable(true);

        return $tabsViewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addOrderOverviewTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::ORDER_NAME)
            ->setTitle(static::ORDER_TITLE)
            ->setTemplate($this->getOrderTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addReportTableTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::REPORT_NAME)
            ->setTitle(static::REPORT_TITLE)
            ->setTemplate($this->getReportsTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @return string
     */
    protected function getOrderTemplate(): string
    {
        return '@Sales/_partials/_tabs/order-overview.twig';
    }

    /**
     * @return string
     */
    protected function getReportsTemplate(): string
    {
        return '@Sales/_partials/_tabs/report-list.twig';
    }
}
