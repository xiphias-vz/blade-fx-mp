<?php

namespace Xiphias\Zed\Reports\Persistence;

use Orm\Zed\Acl\Persistence\SpyAclGroupQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class ReportsPersistenceFactory extends AbstractPersistenceFactory
{
    public function createAclGroupQuery()
    {
        return new SpyAclGroupQuery();
    }
}
