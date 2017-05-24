<?php

namespace Evaneos\Archi\Domain;

class Pokemon
{
    /** @var PokemonId */
    private $id;

    /** @var string */
    private $type;

    /** @var int */
    private $level;

    public function __construct(PokemonId $pokemonId, $type, $level)
    {
        $this->id = $pokemonId;
        $this->type = $type;
        $this->level = $level;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLevel()
    {
        return $this->level;
    }
}