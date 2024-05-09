<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Communication;

use Spryker\Zed\Acl\Communication\AclCommunicationFactory as SprykerAclCommunicationFactory;
use Symfony\Component\Form\FormInterface;
use Xiphias\Zed\Acl\Communication\Form\RoleForm;

/**
 * @method \Spryker\Zed\Acl\Persistence\AclRepositoryInterface getRepository()
 * @method \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Acl\Persistence\AclEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Acl\Business\AclFacadeInterface getFacade()
 * @method \Pyz\Zed\Acl\AclConfig getConfig()
 */
class AclCommunicationFactory extends SprykerAclCommunicationFactory
{
    /**
     * @param array<string, mixed> $data
     * @param array<string, mixed> $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createRoleForm(array $data = [], array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(RoleForm::class, $data, $options);
    }
}
