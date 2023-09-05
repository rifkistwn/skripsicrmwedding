<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $admin_creator = User::role('admin')->first();

        $title = $this->faker->sentence(5);

        return [
            'title' => $title,
            'description' => $this->faker->paragraph(10),
            'slug' => Str::slug($title, '-'),
            'created_by' => $admin_creator->id,
            'updated_by' => $admin_creator->id
        ];
    }
}
