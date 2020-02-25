## Install ##

    $ git clone

Install composer requirements

    $ composer install

Create ur env.local

    $ cp .env .env.local

Prepare doctrine

    $ php bin/console doctrine:database:create

    $ php bin/console doctrine:schema:update --force

For generate/regenerate test tree use this

    $ php bin/console doctrine:fixtures:load