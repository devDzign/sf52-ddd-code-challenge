<?php

namespace Chabour\Domain\Security\Presenter;

use Chabour\Domain\Security\Response\RegistrationResponse;

/**
 * Interface RegistrationPresenterInterface
 * @package Chabour\Domain\Security\Presenter
 */
interface RegistrationPresenterInterface
{

    /**
     * @param RegistrationResponse $response
     */
    public function present(RegistrationResponse $response): void;
}
