<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'NOMBRE_CLIENTE' => $this->faker->name(),
            'DIRECCION_CLIENTE' => $this->faker->address(),
            'TELEFONO_CLIENTE' => $this->faker->phoneNumber(),
            'CORREO_CLIENTE' => $this->faker->unique()->safeEmail(),
            'CC_NIT_CLIENTE' => $this->faker->unique()->numerify('##########'),
        ];
    }
}