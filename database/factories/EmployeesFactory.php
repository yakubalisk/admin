<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Employees;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees>
 */
class EmployeesFactory extends Factory
{

    protected $model = Employees::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000),
            'user_id' =>  User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            // 'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'position' => $this->faker->jobTitle,
            'status' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
