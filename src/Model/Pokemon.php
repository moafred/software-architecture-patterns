<?php

namespace Evaneos\Archi\Model;

class Pokemon
{
    /** @var string */
    private $uuid;

    /** @var string */
    private $type;

    /** @var int */
    private $level;

    private function __construct($uuid, $type, $level)
    {
        $this->uuid = $uuid;
        $this->type = $type;
        $this->level = $level;
    }

    public static function fromArray(array $array)
    {
        return new self($array['uuid'], $array['type'], $array['level']);
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function toArray()
    {
        return [
            'uuid'  => $this->uuid,
            'type'  => $this->type,
            'level' => $this->level,
        ];
    }
}