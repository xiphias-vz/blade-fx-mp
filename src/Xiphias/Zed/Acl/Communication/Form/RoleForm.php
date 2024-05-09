<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Communication\Form;

use Spryker\Zed\Acl\Communication\Form\RoleForm as SprykerRoleForm;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \Spryker\Zed\Acl\Persistence\AclRepositoryInterface getRepository()
 * @method \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Acl\Business\AclFacadeInterface getFacade()
 * @method \Pyz\Zed\Acl\AclConfig getConfig()
 * @method \Spryker\Zed\Acl\Communication\AclCommunicationFactory getFactory()
 */
class RoleForm extends SprykerRoleForm
{
    /**
     * @var string
     */
    protected const FIELD_BFX_ROLE = 'is_bfx_role';

    /**
     * @var string
     */
    protected const LABEL_BFX_ROLE = 'Is BladeFx role';

    /**
     * @var string
     */
    protected const FIELD_BFX_ROLE_KEY = 'bfx_role_key';

    /**
     * @var string
     */
    protected const LABEL_BFX_ROLE_KEY = 'BladeFx role key';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $this->addBfxRoleKeyField($builder);
        $this->addBladeFxRoleField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addBladeFxRoleField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_BFX_ROLE, CheckboxType::class, [
            'label' => static::LABEL_BFX_ROLE,
            'required' => false,
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addBfxRoleKeyField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_BFX_ROLE_KEY, TextType::class, [
            'label' => static::LABEL_BFX_ROLE_KEY,
            'required' => false,
        ]);

        return $this;
    }
}
