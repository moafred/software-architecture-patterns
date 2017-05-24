<?php

namespace Evaneos\Archi\Domain;


class Pokedex
{
    private $evolutions = [
        'pikachu' => 'Raichu'
    ];

    /**
     * @param Pokemon $pokemon
     * @return null|string
     */
    public function getEvolution(Pokemon $pokemon)
    {
        if (!isset($this->evolutions[$pokemon->getType()])) {
            return null;
        }

        return $this->evolutions[$pokemon->getType()];
    }
}