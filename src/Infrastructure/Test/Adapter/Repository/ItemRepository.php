<?php

namespace App\Infrastructure\Test\Adapter\Repository;




use Chabour\Domain\Exemple\Gateway\ItemGateway;
use Chabour\Domain\Exemple\Model\Item;

class ItemRepository implements ItemGateway
{
    /**
     * @inheritDoc
     */
    public function find(int $id): Item
    {
        return new Item($id, "name");
    }
}
