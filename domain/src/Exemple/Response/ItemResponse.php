<?php

namespace Chabour\Domain\Exemple\Response;

use Chabour\Domain\Exemple\Model\Item;

/**
 * Class ItemResponse
 * @package Chabour\Domain\Exemple\Response
 */
class ItemResponse
{
    /**
     * @var Item
     */
    private Item $item;

    /**
     * BarResponse constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }
}
