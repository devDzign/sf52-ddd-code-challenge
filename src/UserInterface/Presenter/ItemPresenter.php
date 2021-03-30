<?php

namespace App\UserInterface\Presenter;

use App\UserInterface\ViewModel\ItemViewModel;
use Chabour\Domain\Exemple\Presenter\ItemPresenterInterface;
use Chabour\Domain\Exemple\Response\ItemResponse;

class ItemPresenter implements ItemPresenterInterface
{
    /**
     * @var ItemViewModel
     */
    private ItemViewModel $viewModel;

    /**
     * @inheritDoc
     */
    public function present(ItemResponse $response): void
    {
        $this->viewModel = ItemViewModel::fromItem($response->getItem());
    }

    /**
     * @return ItemViewModel
     */
    public function getViewModel(): ItemViewModel
    {
        return $this->viewModel;
    }
}
