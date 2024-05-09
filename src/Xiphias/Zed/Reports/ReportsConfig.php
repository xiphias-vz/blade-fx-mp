<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Xiphias\Shared\Reports\ReportsConstants;

class ReportsConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const PATH_TAG_USER = 'Table';

    /**
     * @var string
     */
    public const PATH_TAG_REPORTS = 'Table1';

    /**
     * @var bool
     */
    protected const DEFAULT_LICENCE_EXP = true;

    /**
     * @var string
     */
    protected const BFX_TOKEN_SESSION_KEY = 'bfx_token';

    /**
     * @var string
     */
    protected const BFX_USER_ID_SESSION_KEY = 'bfx_user_id';

    /**
     * @var string
     */
    protected const DEFAULT_DATA_RETURN_TYPE = 'JSON';

    /**
     * @var string
     */
    protected const DEFAULT_CATEGORY_QUERY_KEY = 'category';

    /**
     * @var int
     */
    protected const DEFAULT_CATEGORY_INDEX = -1;

    /**
     * @var int
     */
    protected const DEFAULT_LAYOUT = 0;

    /**
     * @var array
     */
    protected const REPORTS_TABLE_COLUMN_MAP = [
        'isFavorite' => 'Is Favorite',
        'repId' => 'rep_id',
        'repName' => 'rep_name',
        'repDesc' => 'rep_desc',
        'catName' => 'Category name',
        'isActive' => 'Is active',
        'isDrilldown' => 'Is drilldown',
        'action' => 'action',
    ];

    /**
     * @var array
     */
    protected const SALES_REPORTS_TABLE_COLUMN_MAP = [
        'isFavorite' => 'Is Favorite',
        'repId' => 'rep_id',
        'repName' => 'rep_name',
        'repDesc' => 'rep_desc',
        'catName' => 'Category name',
        'isActive' => 'Is active',
        'isDrilldown' => 'Is drilldown',
        'actions' => 'Actions',
    ];

    /**
     * @var array
     */
    protected const REPORTS_TABLE_RAW_COLUMNS = [
        'isFavorite',
        'isActive',
        'isDrilldown',
        'action',
    ];

    /**
     * @var array
     */
    protected const SALES_REPORTS_TABLE_RAW_COLUMNS = [
        'isFavorite',
        'isActive',
        'isDrilldown',
        'actions',
    ];

    /**
     * @var string
     */
    public const BLADE_FX_ROOT_URL = 'BLADE_FX_ROOT_URL';

    /**
     * @return int
     */
    public function getDefaultCategoryIndex(): int
    {
        return static::DEFAULT_CATEGORY_INDEX;
    }

    /**
     * @return string
     */
    public function getCategoryQueryKey(): string
    {
        return static::DEFAULT_CATEGORY_QUERY_KEY;
    }

    /**
     * @return string
     */
    public function getReturnTypeJson(): string
    {
        return static::DEFAULT_DATA_RETURN_TYPE;
    }

    /**
     * @return string
     */
    public function getDefaultUsername(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_DEFAULT_USER_NAME];
    }

    /**
     * @return string
     */
    public function getDefaultPassword(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_DEFAULT_PASSWORD];
    }

    /**
     * @return bool
     */
    public function getDefaultLicenceExp(): bool
    {
        return static::DEFAULT_LICENCE_EXP;
    }

    /**
     * @return string
     */
    public function getBfxTokenSessionKey(): string
    {
        return static::BFX_TOKEN_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBfxUserIdSessionKey(): string
    {
        return static::BFX_USER_ID_SESSION_KEY;
    }

    /**
     * @return array<string>
     */
    public function getReportsTableColumnMap(): array
    {
        return static::REPORTS_TABLE_COLUMN_MAP;
    }

    /**
     * @return array<string>
     */
    public function getSalesReportsTableColumnMap(): array
    {
        return static::SALES_REPORTS_TABLE_COLUMN_MAP;
    }

    /**
     * @return array<string>
     */
    public function getReportsTableRawColumns(): array
    {
        return static::REPORTS_TABLE_RAW_COLUMNS;
    }

    /**
     * @return array<string>
     */
    public function getSalesReportsTableRawColumns(): array
    {
        return static::SALES_REPORTS_TABLE_RAW_COLUMNS;
    }

    /**
     * @return string
     */
    public function getRootUrl(): string
    {
        return $this->get(static::BLADE_FX_ROOT_URL);
    }

    /**
     * @return int
     */
    public function getDefaultLayout(): int
    {
        return static::DEFAULT_LAYOUT;
    }

    /**
     * @return string
     */
    public function getParamFormRootUrl(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_ROOT_URL);
    }
}
