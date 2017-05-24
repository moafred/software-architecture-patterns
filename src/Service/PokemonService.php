<?php

namespace Evaneos\Archi\Service;


use Evaneos\Archi\DataAccess\PokemonDataAccess;
use Evaneos\Archi\Model\Pokemon;
use Ramsey\Uuid\Uuid;

class PokemonService
{
    /** @var PokemonDataAccess */
    private $dataAccess;

    private $pokemons = [
        'pikachu',
        'tortank'
    ];

    /**
     * PokemonService constructor.
     * @param PokemonDataAccess $dataAccess
     */
    public function __construct(PokemonDataAccess $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * @return Pokemon[]
     */
    public function getPokedex()
    {
        $pokemons = $this->dataAccess->getAll();
        array_walk($pokemons, function (&$pokemon) {
            $pokemon = Pokemon::fromArray($pokemon);
        });

        return $pokemons;
    }

    /**
     * @param $uuid
     * @return Pokemon|null
     */
    public function get($uuid)
    {
        $array = $this->dataAccess->get($uuid);
        return (false !== $array) ? Pokemon::fromArray($array) : null;
    }

    /**
     * @param $type
     * @return bool
     */
    public function isValidType($type)
    {
        return in_array($type, $this->pokemons);
    }

    /**
     * @param $level
     * @return bool
     */
    public function isValidLevel($level)
    {
        return $level > 0 && $level <= 30;
    }

    /**
     * @param $type
     * @param $level
     * @return bool|Pokemon
     */
    public function capture($type, $level)
    {
        if (!$this->isValidType($type) && !$this->isValidLevel($level)) {
            return false;
        }

        $uuid = (string) Uuid::uuid4();

        $this->dataAccess->capture($uuid, $type, $level);

        return Pokemon::fromArray([
            'uuid'  => $uuid,
            'type'  => $type,
            'level' => $level,
        ]);
    }

    /**
     * @param array $pokemon
     * @return bool
     */
    private function canEvolve(array $pokemon)
    {
        if ($pokemon['level'] < 7) {
            return false;
        }

        if ($pokemon['level'] >= 15) {
            return false;
        }

        return true;
    }

    /**
     * @param $pokemon
     * @return array|bool
     */
    public function evolve(array $pokemon)
    {
        if (!$this->canEvolve($pokemon)) {
            // @TODO throw error
            return false;
        }

        // @todo whoops
        $newType = 'Raichu';

        $this->dataAccess->changeType($pokemon['uuid'], $newType);

        return Pokemon::fromArray([
            'uuid'  => $pokemon['uuid'],
            'type'  => $newType,
            'level' => $pokemon['level'],
        ]);
    }
}