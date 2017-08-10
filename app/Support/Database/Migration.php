<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Confee\Support\Database;

use Illuminate\Database\Migrations\Migration as LaravelMigration;

/**
 * Description of Migration
 *
 * @author root
 */
abstract class Migration extends LaravelMigration {

    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    public function __construct() {
        $this->schema = app('db')->connection()->getSchemaBuilder();
        $this->schema->enableForeignKeyConstraints();
    }

    abstract function up();

    abstract function down();
}
