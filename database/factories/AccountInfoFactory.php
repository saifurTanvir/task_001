<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\v1\AccountInfo>
 */
class AccountInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'bank_name' => array_rand(['bank' => 'bank', 'card' => 'card']),
            'currency' => array_rand(['dollar' => 'dollar', 'taka' => 'taka']),
            'current_balance' => rand(5000, 10000)
        ];
    }
}
