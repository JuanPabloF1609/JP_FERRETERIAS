<?php

namespace Database\Factories;

use App\Models\Alerta;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlertaFactory extends Factory
{
    protected $model = Alerta::class;

    public function definition()
    {
        return [
            'ID_PRODUCTO' => Producto::factory(),
            'COMENTARIO' => $this->faker->sentence(),
            'ESTADO_ALERTA' => 'Pendiente',
            'FECHA_ALERTA' => $this->faker->dateTime(),
        ];
    }
}