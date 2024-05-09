<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor;

use Generated\Shared\Transfer\CategoryReaderRequestTransfer;
use Generated\Shared\Transfer\ReportsReaderRequestTransfer;
use Generated\Shared\Transfer\ReportsUpdaterRequestTransfer;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class RequestProcessor implements RequestProcessorInterface
{
    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface
     */
    protected BladeFxCategoryReaderInterface $categoryReader;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface
     */
    protected ReportsReaderInterface $reportsReader;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface
     */
    protected ReportsUpdaterInterface $reportsUpdater;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface $categoryReader
     * @param \Xiphias\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface $reportsReader
     * @param \Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface $reportsUpdater
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxCategoryReaderInterface $categoryReader,
        ReportsReaderInterface $reportsReader,
        ReportsUpdaterInterface $reportsUpdater,
        ReportsConfig $config,
    ) {
        $this->categoryReader = $categoryReader;
        $this->reportsReader = $reportsReader;
        $this->reportsUpdater = $reportsUpdater;
        $this->config = $config;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processCategoryTreeListRequest(Request $request): array
    {
        $activeCategory = $request->query->getInt(
            $this->config->getCategoryQueryKey(),
            $this->config->getDefaultCategoryIndex(),
        );

        $categoryReaderRequestTransfer = (new CategoryReaderRequestTransfer())
            ->setActiveCategory($activeCategory);

        return $this->categoryReader
            ->getAllCategories($categoryReaderRequestTransfer)
            ->getCategoriesList()
            ->getArrayCopy();
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    public function processSetFavoriteReportRequest(Request $request): void
    {
        $repId = $request->query->getInt('rep_id');
        $isFavorite = $request->query->getBoolean('is_favorite');

        $updaterRequestTransfer = (new ReportsUpdaterRequestTransfer())
            ->setRepId($repId)
            ->setIsFavorite($isFavorite);

        $this->reportsUpdater->updateFavorite($updaterRequestTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processGetReportsRequest(Request $request): array
    {
        $categoryId = $request->query->getInt(
            $this->config->getCategoryQueryKey(),
            $this->config->getDefaultCategoryIndex(),
        );

        $reportsReaderRequestTransfer = (new ReportsReaderRequestTransfer())->setActiveCategory($categoryId);

        return $this->reportsReader
            ->getReportsList($reportsReaderRequestTransfer)
            ->getReportsList()
            ->getArrayCopy();
    }
}
