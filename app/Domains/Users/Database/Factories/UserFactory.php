<?php

namespace Confee\Domains\Users\Database\Factories;

use Confee\Domains\Users\User;
use Confee\Support\Database\ModelFactory;

/**
 * Class UserFactory.
 */
class UserFactory extends ModelFactory {

    protected $model = User::class;

    protected function fields() {
        static $password;
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'name' => $this->faker->name($gender),
            'email' => $this->faker->safeEmail,
            'password' => $password ? : $password = bcrypt('secret'),
            'remember_token' => str_random(10),
            'sexo' => $gender === 'male' ? 'M' : 'F',
        ];
    }

}
