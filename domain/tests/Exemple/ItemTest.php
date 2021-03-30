<?php

namespace Chabour\Domain\Tests\Exemple;

use Chabour\Domain\Exemple\Gateway\ItemGateway;
use Chabour\Domain\Exemple\Model\Item;
use Chabour\Domain\Exemple\Presenter\ItemPresenterInterface;
use Chabour\Domain\Exemple\Request\ItemRequest;
use Chabour\Domain\Exemple\Response\ItemResponse;
use Chabour\Domain\Exemple\UseCase\ItemUseCase;
use PHPUnit\Framework\TestCase;
use TBoileau\CodeChallenge\Domain\Foo\Response\BarResponse;

/**
 * Class ItemTest
 * @package Chabour\Domain\Tests\Exemple
 */
class ItemTest extends TestCase
{
    public function test(): void
    {
        $request = new ItemRequest(1);

        $repository = new class () implements ItemGateway {
            public function find(int $id): Item
            {
                return new Item($id, 'name');
            }
        };

        $presenter = new class () implements ItemPresenterInterface {
            public ItemResponse $response;

            public function present(ItemResponse $response): void
            {
                $this->response = $response;
            }
        };

        $useCase = new ItemUseCase($repository);

        $useCase->execute($request, $presenter);

        $this->assertInstanceOf(ItemResponse::class, $presenter->response);
        $this->assertEquals(1, $presenter->response->getItem()->getId());
        $this->assertEquals("name", $presenter->response->getItem()->getName());
    }
}
