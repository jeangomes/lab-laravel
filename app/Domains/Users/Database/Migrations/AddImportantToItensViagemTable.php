<?php

namespace Confee\Domains\Users\Database\Migrations;

use Confee\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImportantToItensViagemTable extends Migration {

    public function down() {
        $this->schema->table('itens_viagem', function (Blueprint $table) {
            //$table->dropColumn('important');
        });
    }

    public function up() {
        $this->schema->table('itens_viagem', function (Blueprint $table) {
            $table->boolean('important');
            $table->foreign('user_id','fk_user_id')->references('id')->on('users');
        });
    }

}
