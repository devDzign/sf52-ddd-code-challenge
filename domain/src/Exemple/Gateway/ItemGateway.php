<?php

namespace Chabour\Domain\Exemple\Gateway;

use Chabour\Domain\Exemple\Model\Item;

/**
 * Interface ItemGateway
 * @package Chabour\Domain\Exemple\Gateway
 */
interface ItemGateway
{
    /**
     * @param int $id
     * @return Item
     */
    public function find(int $id): Item;
}
