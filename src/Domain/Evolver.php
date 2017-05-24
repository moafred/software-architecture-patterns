<?php

namespace Evaneos\Archi\Domain;

use Evaneos\Archi\Domain\Exception\CannotEvolveException;
use Evaneos\Archi\Domain\Exception\NoEvolutionFound;

class Evolver
{
    /** @var  Pokedex */
    private $pokedex;

    /**
     * Evolver constructor.
     * @param Pokedex $pokedex
     */
    public function __construct(Pokedex $pokedex)
    {
        $this->pokedex = $pokedex;
    }

    /**
     * @param Pokemon $pokemon
     * @return Pokemon
     * @throws CannotEvolveException
     * @throws NoEvolutionFound
     */
    public function evolve(Pokemon $pokemon)
    {
        if ($pokemon->getLevel() < 7) {
            throw new CannotEvolveException();
        }

        if ($pokemon->getLevel() >= 15) {
            throw new CannotEvolveException();
        }

        $evolution = $this->pokedex->getEvolution($pokemon);
        if (!$evolution) {
            throw new NoEvolutionFound();
        }

        return new Pokemon($pokemon->getId(), $evolution, $pokemon->getLevel());
    }
}