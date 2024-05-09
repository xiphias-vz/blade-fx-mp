<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Table;

use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsTable extends AbstractTable
{
    /**
     * @var string
     */
    protected const ACTIVE_MODIFIER = 'active';

    /**
     * @var string
     */
    protected const MODIFIER_PREFIX = '--';

    /**
     * @var string
     */
    protected const FAVORITE_URL = '/reports/index/favorite-report';

    /**
     * @var string
     */
    protected const ELEMENT_PROPERTY_CHECKED = 'checked';

    /**
     * @var string
     */
    protected const URL_PARAM_REPORT_ID = 'rep_id';

    /**
     * @var string
     */
    protected const URL_PARAM_IS_FAVORITE = 'is_favorite';

    /**
     * @var string
     */
    protected const EDIT_BUTTON_NAME = 'Edit';

    /**
     * @var string
     */
    protected const EDIT_URL_FORMAT = '/reports/index/report-iframe?repId=%s';

    /**
     * @var \Xiphias\Zed\Reports\Business\ReportsFacadeInterface
     */
    protected ReportsFacadeInterface $reportsFacade;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $reportsConfig;

    /**
     * @param \Xiphias\Zed\Reports\Business\ReportsFacadeInterface $reportsFacade
     * @param \Xiphias\Zed\Reports\ReportsConfig $reportsConfig
     */
    public function __construct(ReportsFacadeInterface $reportsFacade, ReportsConfig $reportsConfig)
    {
        $this->reportsFacade = $reportsFacade;
        $this->reportsConfig = $reportsConfig;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader($this->getCsvHeaders());
        $this->mapRawColumns($config);

        $queryParams = $this->generateQueryParams();

        $url = Url::generate('reports-table', $queryParams)->build();
        $config->setUrl($url);

        return $config;
    }

    /**
     * @return array<string>
     */
    public function getCsvHeaders(): array
    {
        return $this->reportsConfig->getReportsTableColumnMap();
    }

    /**
     * @param array $item
     *
     * @return array
     */
    protected function createActionUrls(array $item): array
    {
        $urls = [];

        $urls[] = $this->generateViewButton(
            (string)Url::generate('/reports/detail', [
                'rep_id' => $item[''],
            ]),
            'View',
        );

        return $urls;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return void
     */
    public function mapRawColumns(TableConfiguration $config): void
    {
        $rawColumns = $this->reportsConfig->getReportsTableRawColumns();

        foreach ($rawColumns as $column) {
            $config->addRawColumn($column);
        }
    }

    /**
     * @return array
     */
    protected function generateQueryParams(): array
    {
        $queryParams = [];

        $urlParams = $this->request->query->all();

        foreach ($urlParams as $key => $value) {
            $queryParams[$key] = $value;
        }

        return $queryParams;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $reportList = $this->reportsFacade
            ->processGetReportsRequest($this->request);

        $results = [];

        /**
         * @var \Generated\Shared\Transfer\BladeFxReportTransfer $reportListItem
         */
        foreach ($reportList as $reportListItem) {
            $results[] = [
                'isFavorite' => $this->formatIsFavoriteField(
                    $reportListItem->getRepId(),
                    $reportListItem->getIsFavorite(),
                ),
                'repId' => $reportListItem->getRepId(),
                'repName' => $reportListItem->getRepName(),
                'repDesc' => $reportListItem->getRepDesc(),
                'catName' => $reportListItem->getCatName(),
                'isActive' => $this->formatIsActiveField(
                    $reportListItem->getIsActive(),
                ),
                'isDrilldown' => $this->formatIsDrillDownField(
                    $reportListItem->getIsDrilldown(),
                ),
                'action' => $this->generateEditButton(
                    $this->buildEditUrl($reportListItem->getRepId()),
                    static::EDIT_BUTTON_NAME,
                ),
            ];
        }

        return $results;
    }

    /**
     * @param int $repId
     * @param bool|null $isFavorite
     *
     * @return string
     */
    protected function formatIsFavoriteField(int $repId, ?bool $isFavorite = null): string
    {
        $categoryKey = $this->reportsConfig->getCategoryQueryKey();
        $categoryId = $this->request->query->getInt(
            $categoryKey,
            $this->reportsConfig->getDefaultCategoryIndex(),
        );

        $activeClass = $isFavorite ? $this->generateActiveModifier() : '';

        $url = Url::generate(static::FAVORITE_URL, [
            static::URL_PARAM_REPORT_ID => $repId,
            static::URL_PARAM_IS_FAVORITE => $isFavorite ?? false,
            $categoryKey => $categoryId,
        ]);

        return sprintf('<a href="%s"><i class="fa fa-star toggle-icon%s"></i></a>', $url, $activeClass);
    }

    /**
     * @param bool $isActive
     *
     * @return string
     */
    protected function formatIsActiveField(bool $isActive = false): string
    {
        $checkedStr = $isActive ? static::ELEMENT_PROPERTY_CHECKED : '';

        return '<input type="checkbox" disabled ' . $checkedStr . ' />';
    }

    /**
     * @param bool $isDrilldown
     *
     * @return string
     */
    protected function formatIsDrillDownField(bool $isDrilldown = false): string
    {
        $checkedStr = $isDrilldown ? static::ELEMENT_PROPERTY_CHECKED : '';

        return '<input type="checkbox" disabled ' . $checkedStr . ' />';
    }

    /**
     * @return string
     */
    protected function generateActiveModifier(): string
    {
        return sprintf('%s%s', static::MODIFIER_PREFIX, static::ACTIVE_MODIFIER);
    }

    /**
     * @param int $repId
     *
     * @return string
     */
    protected function buildEditUrl(int $repId): string
    {
        return sprintf(static::EDIT_URL_FORMAT, $repId);
    }
}
