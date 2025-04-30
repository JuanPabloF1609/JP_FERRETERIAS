<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            'NOMBRE_CATEGORIA' => $this->faker->word(),
            'DESCRIPCION' => $this->faker->sentence(),
            'ESTADO' => 'activo',
        ];
    }
}