<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * @var array|\string[][]
     */
    private array $currencies = [
        [
            'name' => 'Bitcoin',
            'ticker' => 'BTC'
        ],
        [
            'name' => 'Ethereum',
            'ticker' => 'ETH'
        ],
        [
            'name' => 'Monero',
            'ticker' => 'XMR'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->currencies as $currency) {
            Currency::create($currency);
        }
    }
}
