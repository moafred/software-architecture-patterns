<?php
namespace Evaneos\Archi\Domain;


use Evaneos\Archi\Domain\Exception\IncorrectLevelForCapture;
use Evaneos\Archi\Domain\Exception\PokemonTypeNotFound;

class Capturer
{
    private $pokedex;

    /**
     * Capturer constructor.
     * @param Pokedex $pokedex
     */
    public function __construct(Pokedex $pokedex)
    {
        $this->pokedex;
    }

    /**
     * @param $type
     * @param $level
     * @return Pokemon
     * @throws IncorrectLevelForCapture
     * @throws PokemonTypeNotFound
     */
    public function capture($type, $level)
    {
        if (!$this->pokedex->exists($type)) {
            throw new PokemonTypeNotFound();
        }

        if ($level < 0 || $level > 30) {
            throw new IncorrectLevelForCapture();
        }

        return new Pokemon(PokemonId::generate(), $type, $level);
    }
}