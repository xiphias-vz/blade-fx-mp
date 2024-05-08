<?php

namespace Pyz\Zed\User\Communication\Controller;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\User\Communication\Controller\EditController as SprykerEditController;
use Symfony\Component\HttpFoundation\Request;

class EditController extends SprykerEditController
{
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

        //changes here

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $formData = $userForm->getData();
            $userTransfer = new UserTransfer();
            $userTransfer->fromArray($formData, true);
            $userTransfer->setIdUser($idUser);
            $this->getFacade()->updateUser($userTransfer);

            $this->deleteAclGroups($idUser);
            $this->addAclGroups($formData, $userTransfer);

            $this->addSuccessMessage(static::MESSAGE_USER_UPDATE_SUCCESS);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        return $this->viewResponse([
            'userForm' => $userForm->createView(),
        ]);
    }
}
