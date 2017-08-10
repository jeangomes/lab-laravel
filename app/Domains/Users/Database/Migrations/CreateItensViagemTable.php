<?php

namespace Confee\Domains\Users\Database\Migrations;

use Confee\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItensViagemTable extends Migration {

    public function down() {
        $this->schema->dropIfExists('itens_viagem');
        
    }

    public function up() {
        $this->schema->create('itens_viagem', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('type');
            $table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
            $table->string('date_buy');
            $table->decimal('price_buy');
            $table->timestamps();
        });
    }

}
