<?php

namespace Database\Factories;

use App\Enums\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // random transaction type
        $type = $this->faker->randomElement(TransactionType::cases());
        //

        return [
            'type' => 0,
            'add' => $this->randomFloat(2, 1, 1000),
            'total' => $this->randomFloat(2, 1, 10000),
            'user_id' => User::Factory(),
        ];
    }
}
