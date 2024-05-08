<?php

namespace PyzXiphias\Zed\Reports\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \PyzXiphias\Zed\Reports\Persistence\ReportsPersistenceFactory getFactory()
 */
class ReportsRepository extends AbstractRepository implements ReportsRepositoryInterface
{
    public function findBladeFxGroupById(array $groupRoles)
    {
        $aclGroupQuery = $this->getFactory()->createAclGroupQuery();

        // TODO: Implement findBladeFxGroupById() method.
        foreach ($groupRoles as $groupRole) {
            $aclGroupQuery
                ->select('name')
                ->findByIdAclGroup($groupRole);

            $test = '';
        }
    }
}
