<?php

namespace Pyz\Zed\User\Communication\Controller;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\User\Communication\Controller\EditController as SprykerEditController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\User\Communication\UserCommunicationFactory getFactory()
 */
class EditController extends SprykerEditController
{
    public function createAction(Request $request)
    {
        $dataProvider = $this->getFactory()->createUserFormDataProvider();

        $userForm = $this->getFactory()
            ->createUserForm(
                [],
                $dataProvider->getOptions(),
            )
            ->handleRequest($request);

        $viewData = [
            'userForm' => $userForm->createView(),
        ];

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $formData = $userForm->getData();

            $userTransfer = new UserTransfer();
            $userTransfer->fromArray($formData, true);

            $userTransfer = $this->getFacade()
                ->createUser($userTransfer);

            if ($userTransfer->getIdUser()) {
                $this->addAclGroups($formData, $userTransfer);

                $this->addSuccessMessage(static::MESSAGE_USER_CREATE_SUCCESS);

                return $this->redirectResponse(static::USER_LISTING_URL);
            }

            $this->addErrorMessage(static::MESSAGE_USER_CREATE_ERROR);
        }

        return $this->viewResponse($viewData);
    }

    public function updateAction(Request $request)
    {
        $idUser = $this->castId($request->get(static::PARAM_ID_USER));

        if (!$idUser) {
            $this->addErrorMessage(static::MESSAGE_ID_USER_EXTRACT_ERROR);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        $dataProvider = $this->getFactory()->createUserUpdateFormDataProvider();
        $providerData = $dataProvider->getData($idUser);

        if ($providerData === null) {
            $this->addErrorMessage(static::MESSAGE_USER_NOT_FOUND);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        $userForm = $this->getFactory()
            ->createUpdateUserForm(
                $providerData,
                $dataProvider->getOptions(),
            )
            ->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $formData = $userForm->getData();
            $userTransfer = new UserTransfer();
            $userTransfer->fromArray($formData, true);
            $userTransfer->setIdUser($idUser);
            $this->getFacade()->updateUser($userTransfer);

            $this->deleteAclGroups($idUser);
            $this->addAclGroups($formData, $userTransfer);

            //changes here
            $test = $this->getFactory()->getBladeFxFacade()->createUserOnBladeFx($userForm->getData()['group']);

            $this->addSuccessMessage(static::MESSAGE_USER_UPDATE_SUCCESS);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        return $this->viewResponse([
            'userForm' => $userForm->createView(),
        ]);
    }
}
