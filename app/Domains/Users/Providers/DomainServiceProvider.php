<?php

namespace Confee\Domains\Users\Providers;

use Confee\Domains\Users\Database\Factories\UserFactory;

use Confee\Domains\Users\Database\Migrations\CreatePasswordResetsTable;
use Confee\Domains\Users\Database\Migrations\CreateUsersTable;
use Confee\Domains\Users\Database\Migrations\CreateItensViagemTable;


use Illuminate\Support\ServiceProvider;
use Migrator\MigratorTrait as HasMigrations;
use Confee\Domains\Users\Database\Seeders\UserSeeder;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

/**
 * Class DomainServiceProvider.
 */
class DomainServiceProvider extends ServiceProvider {

    use HasMigrations;

    public function register() {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_BR');
        });
        $this->registerMigrations();
        $this->registerFactories();
        $this->registerSeeders();
    }

    protected function registerMigrations() {
        $this->migrations([
            CreateUsersTable::class,
            CreatePasswordResetsTable::class,
            CreateItensViagemTable::class,
            \Confee\Domains\Users\Database\Migrations\AddImportantToItensViagemTable::class,
        ]);
    }

    protected function registerFactories() {
        (new UserFactory())->define();
    }

    protected function registerSeeders() {
        $this->seeders([
            UserSeeder::class
        ]);
    }

}
