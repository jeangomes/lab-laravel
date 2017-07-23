<?php

namespace Confee\Domains\Users\Database\Migrations;

use Confee\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends Migration {

    public function down() {
        $this->schema->dropIfExists('password_resets');
    }

    public function up() {
        $this->schema->create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

//put your code here
}
