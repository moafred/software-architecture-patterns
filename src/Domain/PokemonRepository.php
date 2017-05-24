<?php

namespace Evaneos\Archi\Domain;


interface PokemonRepository
{
    /**
     * @param PokemonId
     * @return Pokemon
     */
    public function get(PokemonId $pokemonId);

    /**
     * @param Pokemon $pokemon
     * @return mixed
     */
    public function add(Pokemon $pokemon);

    /**
     * @param Pokemon $pokemon
     * @return mixed
     */
    public function remove(Pokemon $pokemon);
}