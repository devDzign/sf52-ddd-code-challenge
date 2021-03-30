<?php

namespace Chabour\Domain\Exemple\Presenter;

use Chabour\Domain\Exemple\Response\ItemResponse;

/**
 * Interface ItemPresenterInterface
 * @package Chabour\Domain\Exemple\Presenter
 */
interface ItemPresenterInterface
{
    /**
     * @param ItemResponse $response
     */
    public function present(ItemResponse $response): void;
}
