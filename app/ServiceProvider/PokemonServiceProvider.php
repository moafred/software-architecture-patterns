<?php

namespace ServiceProvider;

use Evaneos\Archi\Controllers\PokemonController;
use Evaneos\Archi\Service\PokemonService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PokemonServiceProvider implements ServiceProviderInterface
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
        $app['application.service.pokemon'] = function () use ($app) {
            return new PokemonService(
                $app['application.dataAccess.pokemon']
            );
        };
    }
}
