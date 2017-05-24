<?php

namespace ServiceProvider;

use Evaneos\Archi\Controllers\PokemonController;
use Evaneos\Archi\DataAccess\PokemonDataAccess;
use Evaneos\Archi\Service\PokemonService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PokemonDataAccessProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $app A container instance
     */
    public function register(Container $app)
    {
        $app['application.dataAccess.pokemon'] = function () use ($app) {
            return new PokemonDataAccess($app['db']);
        };
    }
}
