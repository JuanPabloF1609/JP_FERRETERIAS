<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'NOMBRE_PRODUCTO' => $this->faker->word,
            'PRECIO' => $this->faker->randomFloat(2, 10, 1000), 
            'CANTIDAD' => $this->faker->numberBetween(1, 100),
            'STOCK_MINIMO' => $this->faker->numberBetween(1, 10), 
            'ID_CATEGORIA' => null, 
            'REFERENCIA' => $this->faker->unique()->bothify('REF-###??'),
            'DESCRIPCION' => $this->faker->sentence, 
        ];
    }
}