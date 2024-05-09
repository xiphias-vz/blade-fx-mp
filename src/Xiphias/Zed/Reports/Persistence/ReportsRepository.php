<?php

namespace Xiphias\Zed\Reports\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Xiphias\Zed\Reports\Persistence\ReportsPersistenceFactory getFactory()
 */
class ReportsRepository extends AbstractRepository implements ReportsRepositoryInterface
{
    public function findBladeFxGroupById(array $groupRoles)
    {
        $aclGroupQuery = $this->getFactory()->createAclGroupQuery();
        $reportsEntityId = $aclGroupQuery->findByName('BladeFx-Reports-MP')->getIterator()->current()->getIdAclGroup();

        // TODO: Implement findBladeFxGroupById() method.
        if(in_array($reportsEntityId, $groupRoles)) {
            return true;
        }

        return false;
    }
}
