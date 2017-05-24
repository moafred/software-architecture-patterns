<?php

namespace Evaneos\Archi\Domain;


use Ramsey\Uuid\Uuid;

class PokemonId
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return PokemonId
     */
    public static function generate()
    {
        return new self((string) Uuid::uuid4());
    }
}