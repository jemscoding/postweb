<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected static $titleindex = 0;
    protected static $titles = [
        "CSAV College Week 2025",
        "CSAV College Week 2024",
        "CSAV College Week 2023",
        "CSAV College Week 2022",
        "CSAV College Week 2021",
        "CSAV College Week 2020",
        "CSAV College Week 2019",
        "CSAV College Week 2018",
        "CSAV College Week 2017",
        "CSAV College Week 2016",
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //checking if index is out off titles
        if(self::$titleindex >= count(self::$titles)){
            throw new \Exception("No more title");
        }

        $title = self::$titles[self::$titleindex];
        self::$titleindex++;

        //getting a value for paragraph into array
        $paragraphs = [];
        for ($i = 0; $i < 3; $i++) {
        $text = $this->faker->text(1200);
        $words = array_slice(explode(' ', $text), 0, 170);
        $paragraphText = implode(' ', $words);

        $paragraphs[] = 
        // "<h2> lorem ipsum sit amet consectetur adipiscing elit </h2>";
        "<p>" . $paragraphText . "</p>";
        // "<br>" .
        // "<ul>" .
        //    "<li>" . $this->faker->sentence . "</li>" .
        //     "<li>" . $this->faker->sentence . "</li>" .
        //     "<li>". $this->faker->sentence . "</li>" .
        // "</ul>" .
        // "<br>";        
        }    

        $content = implode("\n", $paragraphs); //combine paragraphs into new lines
        return [
            //post schema $fillable
            "post_title" => $title,
            "post_slug" => Str::slug($title),
            "post_content" => $content,
            "is_published" => $this->faker->boolean,
            //picking a random category inRandomOrder method
            "category_id" => Category::inRandomOrder()->first()->id,
        ];
    }
}
