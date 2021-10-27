<?php

namespace Database\Factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'recipient_id' => random_int(1, 1000),
            'payee_id' => random_int(1, 1000),
            'currency_id' => random_int(1, 3),
            'amount' => random_int(1, 1000)
        ];
    }
}
