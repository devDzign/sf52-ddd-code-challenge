<?php

namespace Chabour\Domain\Tests\Exemple;

use Chabour\Domain\Exemple\Presenter\ItemPresenterInterface;
use Chabour\Domain\Exemple\Request\ItemRequest;
use Chabour\Domain\Exemple\Response\ItemResponse;
use Chabour\Domain\Exemple\UseCase\Item;
use PHPUnit\Framework\TestCase;

/**
 * Class ItemTest
 * @package Chabour\Domain\Tests\Exemple
 */
class ItemTest extends TestCase
{
    public function test(): void
    {
        $request = new ItemRequest();

        $presenter = new class() implements ItemPresenterInterface {
            public ItemResponse $response;

            public function present(ItemResponse $response): void
            {
                $this->response = $response;
            }
        };

        $useCase = new Item();

        $useCase->execute($request, $presenter);

        $this->assertInstanceOf(ItemResponse::class, $presenter->response);
    }
}
