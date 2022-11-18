<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'url' => 'http://' . $this->faker->text(20) . '.com',
            'image_url' => 'http://' . $this->faker->text(20) . '.jpeg',
            'news_site' => $this->faker->text(10),
            'summary' => $this->faker->text(10),
            'published_at' => $this->faker->date(),
            'article_updated_at' => $this->faker->date(),
            'featured' => $this->faker->boolean(50),
            'launches' => json_encode([]),
            'events' => json_encode([]),
        ];
    }
}
