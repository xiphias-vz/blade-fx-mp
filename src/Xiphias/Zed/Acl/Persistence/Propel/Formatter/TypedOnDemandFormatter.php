<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Persistence\Propel\Formatter;

use Propel\Runtime\ActiveQuery\BaseModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Formatter\OnDemandFormatter;
use Propel\Runtime\Map\TableMap;

class TypedOnDemandFormatter extends OnDemandFormatter
{
    /**
     * @var array<\Propel\Runtime\ActiveQuery\Join>
     */
    private array $joins;

    /**
     * @param \Propel\Runtime\ActiveQuery\BaseModelCriteria|null $criteria
     * @param \Propel\Runtime\DataFetcher\DataFetcherInterface|null $dataFetcher
     *
     * @return $this
     */
    public function init(?BaseModelCriteria $criteria = null, ?DataFetcherInterface $dataFetcher = null)
    {
        parent::init($criteria, $dataFetcher);

        $this->joins = $criteria->getJoins();

        return $this;
    }

    /**
     * Hydrates a series of objects from a result row
     * Columns added with withColumn() call on query will be added as virtual columns
     * but the field types will be correctly cast
     *
     * @param array $row associative array with data
     *
     * @return \Propel\Runtime\ActiveRecord\ActiveRecordInterface
     */
    public function getAllObjectsFromRow(array $row): ActiveRecordInterface
    {
        $obj = parent::getAllObjectsFromRow($row);
        /** @phpstan-ignore-next-line */
        $numColumnsLeft = $this->tableMap::NUM_COLUMNS;

        $asColumnCount = 0;
        foreach ($this->getAsColumns() as $alias => $clause) {
            $tableMap = $this->getTableMapAndColumnNameFromClause($clause);

            if (!$tableMap) {
                continue;
            }

            [$columnName, $col] = $this->getColumnNameAndIndex($tableMap, $clause);

            $asColumnRow = array_fill(0, count($tableMap->getColumns()), '');
            $asColumnRow[$col] = $row[$numColumnsLeft + $asColumnCount];

            $class = $tableMap->getClassName();
            $joinObj = $this->getSingleObjectFromRow($asColumnRow, $class);

            /** @phpstan-ignore-next-line */
            $columnValue = $joinObj->getByName($columnName);
            /** @phpstan-ignore-next-line */
            $obj->setVirtualColumn($alias, $columnValue);
            $asColumnCount += 1;
        }

        return $obj;
    }

    /**
     * @param string $clause
     *
     * @return \Propel\Runtime\Map\TableMap|null
     */
    private function getTableMapAndColumnNameFromClause(string $clause): TableMap|null
    {
        $tableMap = null;

        foreach ($this->joins as $join) {
            if (str_contains($clause, $join->getRightTableName())) {
                /** @var \Propel\Runtime\Map\TableMap $tableMap */
                /** @phpstan-ignore-next-line */
                $tableMap = $join->getTableMap();
            }
        }

        return $tableMap;
    }

    /**
     * @param \Propel\Runtime\Map\TableMap $tableMap
     * @param string $clause
     *
     * @return array
     */
    private function getColumnNameAndIndex(TableMap $tableMap, string $clause): array
    {
        $columnName = '';
        $col = 0;
        foreach ($tableMap->getColumns() as $column) {
            if (str_contains($clause, $column->getName())) {
                $columnName = $column->getName();

                break;
            }
            $col += 1;
        }

        return [$columnName, $col];
    }
}
