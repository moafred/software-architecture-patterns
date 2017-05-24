<?php

namespace Evaneos\Archi\Controllers;

use Evaneos\Archi\Service\PokemonService;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonController
{
    /** @var PokemonService */
    private $service;

    /**
     * PokemonController constructor.
     *
     * @param PokemonService $service
     */
    public function __construct(PokemonService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function pokedex(Request $request)
    {
        $pokedex = $this->service->getPokedex();

        array_walk($pokedex, function (&$pokemon) {
            $pokemon = $pokemon->toArray();
        });

        return new JsonResponse([$pokedex]);
    }

    /**
     * @param $uuid
     * @return JsonResponse
     */
    public function getInformation($uuid)
    {
        $pokemon = $this->service->get($uuid);

        if (null === $pokemon) {
            return new JsonResponse(new \stdClass(), 404);
        }

        return new JsonResponse($pokemon->toArray());
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function capture(Request $request)
    {
        $type = $request->get('type');
        $level = (int) $request->get('level');

        $capturedPokemon = $this->service->capture($type, $level);
        if (false === $capturedPokemon) {
            return new JsonResponse('Pokemon not exists', Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($capturedPokemon->toArray());
    }

    /**
     * @param string $uuid
     *
     * @return JsonResponse
     */
    public function evolve($uuid)
    {
        $pokemon = $this->service->get($uuid);

        if (!$pokemon) {
            return new JsonResponse('Pokemon does not exists', Response::HTTP_BAD_REQUEST);
        }

        $evolvedPokemon = $this->service->evolve($pokemon);
        // @TODO catch Error instead
        if (false === $evolvedPokemon) {
            return new JsonResponse('Pokemon cannot evolve', Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($pokemon->toArray());
    }
}
