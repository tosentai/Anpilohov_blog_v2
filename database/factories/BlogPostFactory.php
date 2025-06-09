<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 8), true);
        $txt = $this->faker->realText(rand(1000, 4000));
        $date = $this->faker->dateTimeBetween('-3 months', '-2 months');

        $createdAt = $date;
        $updatedAt = $date;
        $publishedAt = null;
        $isPublished = false;

        if (rand(1, 5) > 1) {
            $isPublished = true;
            $publishedAt = $date;
        }

        $category_id = rand(1, 11);

        $user_id = (rand(1, 2) == 5) ? 1 : 2;
        $user_id = rand(1, 2);

        return [
            'category_id'  => $category_id,
            'user_id'      => $user_id,
            'title'        => $title,
            'slug'         => Str::slug($title),
            'excerpt'      => $this->faker->text(rand(40, 100)),
            'content_raw'  => $txt,
            'content_html' => $txt,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'created_at'   => $createdAt,
            'updated_at'   => $updatedAt,
        ];
    }
}
