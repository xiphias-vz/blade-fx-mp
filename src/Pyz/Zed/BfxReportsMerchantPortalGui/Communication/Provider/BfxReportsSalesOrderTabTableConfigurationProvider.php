<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;

class BfxReportsSalesOrderTabTableConfigurationProvider
{
    /**
     * @var string
     */
    public const COL_KEY_SKU = 'sku';

    /**
     * @var string
     */
    public const COL_KEY_IMAGE = 'image';

    /**
     * @var string
     */
    public const COL_KEY_NAME = 'name';

    /**
     * @var string
     */
    public const COL_KEY_SUPER_ATTRIBUTES = 'superAttributes';

    /**
     * @var string
     */
    public const COL_KEY_VARIANTS = 'variants';

    /**
     * @var string
     */
    public const COL_KEY_CATEGORIES = 'categories';

    /**
     * @var string
     */
    public const COL_KEY_STORES = 'stores';

    /**
     * @var string
     */
    public const COL_KEY_VISIBILITY = 'visibility';

    /**
     * @var \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    protected $guiTableFactory;

    private MerchantUserFacadeInterface $merchantUserFacade;

    /**
     * @param \Spryker\Shared\GuiTable\GuiTableFactoryInterface $guiTableFactory
     * @param \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface $merchantUserFacade
     */
    public function __construct(
        GuiTableFactoryInterface $guiTableFactory,
        MerchantUserFacadeInterface $merchantUserFacade,
    ) {
        $this->guiTableFactory = $guiTableFactory;
        $this->merchantUserFacade = $merchantUserFacade;
    }

    /**
     * @return \Generated\Shared\Transfer\GuiTableConfigurationTransfer
     */
    public function getConfiguration(): GuiTableConfigurationTransfer
    {
        $idMerchant = $this->merchantUserFacade
            ->getCurrentMerchantUser()
            ->getIdMerchantOrFail();

        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        $guiTableConfigurationBuilder = $this->addColumns($guiTableConfigurationBuilder);
//        $guiTableConfigurationBuilder = $this->addFilters($guiTableConfigurationBuilder);
        $guiTableConfigurationBuilder = $this->addRowActions($guiTableConfigurationBuilder, $idMerchant);

        $guiTableConfigurationBuilder
            ->setDataSourceUrl('/bfx-reports-merchant-portal-gui/bfx-reports/sales-reports-table-data')
            ->setSearchPlaceholder('Search by report name')
            ->setDefaultPageSize(25);

        return $guiTableConfigurationBuilder->createConfiguration();
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addColumns(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder): GuiTableConfigurationBuilderInterface
    {
        $guiTableConfigurationBuilder
            ->addColumnText(BladeFxReportTransfer::REP_ID, 'Report ID', false, false)
            ->addColumnText(BladeFxReportTransfer::REP_NAME, 'Report name', false, false)
            ->addColumnText(BladeFxReportTransfer::REP_DESC, 'Description', false, false)
            ->addColumnText(BladeFxReportTransfer::CAT_NAME, 'Category', false, false);

        return $guiTableConfigurationBuilder;
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addFilters(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder): GuiTableConfigurationBuilderInterface
    {
        $guiTableConfigurationBuilder->addFilterSelect(BladeFxReportTransfer::IS_FAVORITE, 'Favorite', false, [
            '1' => 'Favorite',
            '0' => 'Not favorite',
        ]);
        $guiTableConfigurationBuilder->addFilterSelect(BladeFxReportTransfer::IS_ACTIVE, 'Active', false, [
            '1' => 'Active',
            '0' => 'Not active',
        ]);
        $guiTableConfigurationBuilder->addFilterSelect(BladeFxReportTransfer::IS_DRILLDOWN, 'Drilldown', false, [
            '1' => 'Drilldown',
            '0' => 'Not drilldown',
        ]);

        return $guiTableConfigurationBuilder;
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     * @param int $idMerchant
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addRowActions(
        GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder,
        int $idMerchant,
    ): GuiTableConfigurationBuilderInterface {
        $guiTableConfigurationBuilder->addRowActionHttp(
            'download-pdf',
            'Download as PDF',
            sprintf(
                '/bfx-reports-merchant-portal-gui/bfx-reports/report-download-response-builder?repId=${row.%s}&format=pdf',
                //                'bfx-reports/report-iframe?repId=${row.%s}&merchId=${row.%s}',
                BladeFxReportTransfer::REP_ID,
                //                $idMerchant,
            ),
        );

        $guiTableConfigurationBuilder->addRowActionDrawerUrlHtmlRenderer(
            'report-preview',
            'Preview',
            sprintf(
                '/bfx-reports-merchant-portal-gui/bfx-reports/report-iframe?repId=${row.%s}',
                //                'bfx-reports/report-iframe?repId=${row.%s}&merchId=${row.%s}',
                BladeFxReportTransfer::REP_ID,
                //                $idMerchant,
            ),
        )->setRowClickAction('report-preview');

        return $guiTableConfigurationBuilder;
    }
}
