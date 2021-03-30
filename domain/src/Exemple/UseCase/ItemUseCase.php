<?php

namespace Chabour\Domain\Exemple\UseCase;

use Chabour\Domain\Exemple\Gateway\ItemGateway;
use Chabour\Domain\Exemple\Request\ItemRequest;
use Chabour\Domain\Exemple\Response\ItemResponse;
use Chabour\Domain\Exemple\Presenter\ItemPresenterInterface;

/**
 * Class Item
 * @package Chabour\Domain\Exemple\UseCase
 */
class ItemUseCase
{
    /**
     * @var ItemGateway
     */
    private ItemGateway $itemGateway;

    /**
     * ItemUseCase constructor.
     *
     * @param ItemGateway $itemGateway
     */
    public function __construct(ItemGateway $itemGateway)
    {
        $this->itemGateway = $itemGateway;
    }

    /**
     * @param ItemRequest $request
     * @param ItemPresenterInterface $presenter
     */
    public function execute(ItemRequest $request, ItemPresenterInterface $presenter): void
    {
        $item = $this->itemGateway->find($request->getId());
        $presenter->present(new ItemResponse($item));
    }
}
