<?php

namespace Evaneos\Archi\DataAccess;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class PokemonDataAccess
{
    /** @var Connection */
    private $connection;

    /**
     * PokemonController constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $sql = 'SELECT uuid, type, level FROM pokemon.collection';
        $query = $this->connection->query($sql);

        return $query->fetchAll();
    }

    /**
     * @param string $uuid
     * @return mixed|null
     */
    public function get($uuid)
    {
        $sql = 'SELECT uuid, type, level FROM pokemon.collection WHERE uuid = :uuid';
        $query = $this->connection->prepare($sql);
        $query->bindValue('uuid', $uuid);
        $query->execute();

        $pokemon = $query->fetch();

        return false !== $pokemon ? $pokemon : null;
    }

    public function capture($uuid, $type, $level)
    {
        $sql = 'INSERT INTO pokemon.collection (uuid, type, level) VALUES (:uuid, :type, :level)';
        $query = $this->connection->prepare($sql);
        $query->bindValue('uuid', $uuid);
        $query->bindValue('type', $type);
        $query->bindValue('level', $level);

        return $query->execute();
    }

    public function changeType($uuid, $type)
    {
        $sql = 'UPDATE pokemon.collection SET type = :type WHERE uuid = :uuid';
        $query = $this->connection->prepare($sql);
        $query->bindValue('uuid', $uuid);
        $query->bindValue('type', $type);
        $query->execute();
    }
}