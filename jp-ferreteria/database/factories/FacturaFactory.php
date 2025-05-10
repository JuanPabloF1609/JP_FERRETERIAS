<?php

namespace Database\Factories;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacturaFactory extends Factory
{
    protected $model = Factura::class;

    public function definition()
    {
        return [
            'ID_CLIENTE' => Cliente::factory(),
            'ID_USER' => User::factory(),
            'FECHA_FACTURA' => $this->faker->date(),
            'TOTAL' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}