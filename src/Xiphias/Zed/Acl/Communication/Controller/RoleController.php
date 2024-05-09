<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Communication\Controller;

use Generated\Shared\Transfer\RoleTransfer;
use Spryker\Zed\Acl\Business\Exception\RoleNameExistsException;
use Spryker\Zed\Acl\Business\Exception\RootNodeModificationException;
use Spryker\Zed\Acl\Communication\Controller\RoleController as SprykerRoleController;
use Spryker\Zed\Acl\Communication\Form\RoleForm;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Acl\Persistence\AclRepositoryInterface getRepository()
 * @method \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Acl\Business\AclFacadeInterface getFacade()
 * @method \Spryker\Zed\Acl\Communication\AclCommunicationFactory getFactory()
 */
class RoleController extends SprykerRoleController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function createAction(Request $request)
    {
        $ruleForm = $this->getFactory()
            ->createRoleForm()
            ->handleRequest($request);

        if ($ruleForm->isSubmitted() && $ruleForm->isValid()) {
            $formData = $ruleForm->getData();

            try {
                $roleTransfer = $this->getFacade()->createRole(
                    (new RoleTransfer())->fromArray($formData),
                );

                $this->addSuccessMessage(
                    'Role "%s" successfully added.',
                    ['%s' => $formData[RoleForm::FIELD_NAME]],
                );

                return $this->redirectResponse(
                    sprintf(static::ROLE_UPDATE_URL, $roleTransfer->getIdAclRole()),
                );
            } catch (RoleNameExistsException $e) {
                $this->addErrorMessage($e->getMessage());
            } catch (RootNodeModificationException $e) {
                $this->addErrorMessage($e->getMessage());
            }
        }

        return $this->viewResponse([
            'roleForm' => $ruleForm->createView(),
        ]);
    }
}
