<?php

declare(strict_types=1);

namespace Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use Spryker\Zed\ProductOfferMerchantPortalGui\Dependency\Facade\ProductOfferMerchantPortalGuiToMerchantUserFacadeInterface;
use Xiphias\Zed\Reports\Business\ReportsFacade;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BfxReportsMerchantPortalGuiTableConfigurationProvider
{
    public const COL_KEY_SKU = 'sku';
    public const COL_KEY_IMAGE = 'image';
    public const COL_KEY_NAME = 'name';
    public const COL_KEY_SUPER_ATTRIBUTES = 'superAttributes';
    public const COL_KEY_VARIANTS = 'variants';
    public const COL_KEY_CATEGORIES = 'categories';
    public const COL_KEY_STORES = 'stores';
    public const COL_KEY_VISIBILITY = 'visibility';
    /**
     * @var \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    protected $guiTableFactory;
    private MerchantUserFacadeInterface $merchantUserFacade;

    /**
     * @param GuiTableFactoryInterface $guiTableFactory
     * @param MerchantUserFacadeInterface $merchantUserFacade
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
            ->setDataSourceUrl('/bfx-reports-merchant-portal-gui/bfx-reports/table-data')
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
            ->addColumnChip(BladeFxReportTransfer::IS_FAVORITE, 'Favorite', true, false, 'gray', [
                'true' => 'green',
            ])
            ->addColumnText(BladeFxReportTransfer::REP_ID, 'Report ID', false, false)
            ->addColumnText(BladeFxReportTransfer::REP_NAME, 'Report name', false, false)
            ->addColumnText(BladeFxReportTransfer::REP_DESC, 'Description', false, false)
            ->addColumnText(BladeFxReportTransfer::CAT_NAME, 'Category', false, false)
            ->addColumnChip(BladeFxReportTransfer::IS_ACTIVE, 'Active', false, false, 'gray')
            ->addColumnChip(BladeFxReportTransfer::IS_DRILLDOWN, 'Drilldown', false, false, 'gray');


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
    protected function addRowActions(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder, int $idMerchant): GuiTableConfigurationBuilderInterface
    {
//        $f = (new ReportsFacade())->getReportParamForm((int)BladeFxReportTransfer::REP_ID);



        $guiTableConfigurationBuilder->addRowActionDrawerUrlHtmlRenderer(
             'report-iframe',
                'Edit',
                sprintf(
                    'bfx-reports/report-iframe?repId=${row.%s}',

//                'bfx-reports/report-iframe?repId=${row.%s}&merchId=${row.%s}',
                    BladeFxReportTransfer::REP_ID,
//                $idMerchant,
                )
            )->setRowClickAction('report-iframe');

//        $guiTableConfigurationBuilder->addRowActionDrawerAjaxForm(
//            'show-iframe',
//            'Edit',
//            sprintf(
//                'bfx-reports/report-iframe?repId=${row.%s}',
//
////                'bfx-reports/report-iframe?repId=${row.%s}&merchId=${row.%s}',
//                BladeFxReportTransfer::REP_ID,
////                $idMerchant,
//            )
//        )->setRowClickAction('show-iframe');

        return $guiTableConfigurationBuilder;
    }
}
