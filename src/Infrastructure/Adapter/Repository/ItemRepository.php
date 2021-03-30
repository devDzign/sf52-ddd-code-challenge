<?php

namespace App\Infrastructure\Adapter\Repository;

use Chabour\Domain\Exemple\Gateway\ItemGateway;
use Chabour\Domain\Exemple\Model\Item;

/**
 * Class ItemRepository
 * @package App\Infrastructure\Adapter\Repository
 */
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
