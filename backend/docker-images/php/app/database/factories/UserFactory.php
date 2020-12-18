<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name,
            'email'       => $this->faker->unique()->safeEmail,
	        'password'    => Hash::make('password@1'),
	        'verified_at' => date('Y-m-d H:i:s'),
	        'status'      => 'ACTIVE',
        ];
    }
}
