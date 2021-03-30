<?php

namespace App\UserInterface\Controller;

use Chabour\Domain\Exemple\Presenter\ItemPresenterInterface;
use Chabour\Domain\Exemple\Request\ItemRequest;
use Chabour\Domain\Exemple\UseCase\ItemUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ItemController
{
    #[Route('/api/item/{id}', name: 'api.item')]
    public function __invoke(
        int $id,
        ItemUseCase $itemUseCase,
        ItemPresenterInterface $presenter,
        SerializerInterface $serializer
    ): JsonResponse {
        $itemUseCase->execute(new ItemRequest($id), $presenter);

        return new JsonResponse(
            $serializer->serialize($presenter->getViewModel(), 'json'),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json'],
            true
        );
    }
}
