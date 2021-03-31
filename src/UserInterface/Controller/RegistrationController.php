<?php

namespace App\UserInterface\Controller;

use App\UserInterface\Form\RegistrationType;
use App\UserInterface\Presenter\RegistrationPresenter;
use Chabour\Domain\Security\Request\RegistrationRequest;
use Chabour\Domain\Security\UseCase\Registration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    #[Route('/registration', name: 'app.registration')]
    public function __invoke(
        Request $request,
        Registration $registrationUseCase,
        RegistrationPresenter $registrationPresenter
    ) {
        $form = $this->createForm(RegistrationType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\UserInterface\DataTransferObject\Registration $registrationModel */
            $registrationModel = $form->getData();
            $registrationsRequest           = RegistrationRequest::create(
                $registrationModel->getEmail(),
                $registrationModel->getPseudo(),
                $registrationModel->getPlainPassword()
            );

            $registrationUseCase->execute($registrationsRequest, $registrationPresenter);
            return $this->redirectToRoute('health');
        }

        return $this->render("registration/registration.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
