<?php

namespace Confee\Domains\Users\Database\Migrations;

use Confee\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    public function down() {
        $this->schema->dropIfExists('users');
    }

    public function up() {
        $this->schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('sexo', 1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

}
