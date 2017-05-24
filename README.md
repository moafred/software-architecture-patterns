# Pokedex
http http://archi.local
# Info
http http://archi.local/9afeec28-132f-48d0-8157-65ebdd8360f5
# Capture
http -f POST http://archi.local type=pikachu level=1
# Evolve
http -f PATCH http://archi.local/31928994-eb29-4fad-9166-3b1fdb9db7dc/evolve

Software Architectural Patterns
===============================

First, fork the repo!

Install:
 - `composer install`
 - `composer run`
 - Add an entry in your `etc/hosts` to redirect `archi.local` to your docker host IP (your machine or VM).
 - Go to `http://archi.local`, it should show a json list.

Run tests:
 - `composer test`


Foreword
--------

This is a Silex application (built from the official Silex Skeleton with minor changes).

You'll find the Pimple dependency injection in `app/app.php`
The controllers are mounted in `app/controllers.php`
In `app/ControllerProvider` and `app/ServiceProvider`, you'll find the Silex tool classes for config.

All the domain code will go in `src`.

If you have any question, ask me.


What is it about?
-----------------
For the following exercises, we'll play with pokemons.
There's already some code working. You'll have to complete it.
It will happen in 4 phases (or less if we run out of time).
Do not TDD (workshop is too short).

Here, pokemon has been reduced to very simple features:
 - You can list your pokemons
 - You can get information on one pokemon of your collection
 - You can catch a pokemon (it will add a pokemon to your collection - ie. create it for simplification)
 - You can make a pokemon evolve
    
Max level for a pokemon is 30.
Min level for a pokemon is 1.
A pokemon can evolve when he has attained level 7 (but doesn't have to).
A pokemon can evolve again when he has attained level 15.
A pokemon cannot skip an evolution (`carapuce` can't evolve directly to `tortank`).
There are only 150 pokemons (http://www.poketips.fr/liste/).
    
Phase 1:
--------
Create a branch named `transaction-script`.
Add the missing constraints to `capture` feature.
Implement the `evolve` feature by following the Transaction Script pattern (code everything in the controller).
Don't forget to keep it simple.

Phase 2:
--------
Create a branch named `n-layer` (from `master` or `transaction-script`).
Refactor the code to add a `Service` and a `DataAccess` layers.
Start creating Model objects, but keep them simple.

Phase 3:
--------
Create a branch named `hexagonal` (from `master`, `transaction-script`, or `n-layer`).
Refactor the code to separate what's inside your domain (Business Model and ports) and what's outside (adapters).
Put all your domain logic in the Business Model objects.

Phase 4:
--------
For each of the previous branches, try to CQRS it.
