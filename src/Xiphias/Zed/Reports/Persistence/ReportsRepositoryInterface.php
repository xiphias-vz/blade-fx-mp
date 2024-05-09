<?php

namespace Xiphias\Zed\Reports\Persistence;

interface ReportsRepositoryInterface
{
    public function findBladeFxGroupById(array $groupRoles);
}
