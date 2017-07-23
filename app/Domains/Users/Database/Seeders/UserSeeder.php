<?php

namespace Confee\Domains\Users\Database\Seeders;

use Confee\Domains\Users\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    public function run() {
        factory(User::class)->times(30)->create();
    }

}
