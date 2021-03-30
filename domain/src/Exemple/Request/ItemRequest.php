<?php

namespace Chabour\Domain\Exemple\Request;

/**
 * Class ItemRequest
 * @package Chabour\Domain\Exemple\Request
 */
class ItemRequest
{
    /**
     * @var int
     */
    private int $id;

    /**
     * BarRequest constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
