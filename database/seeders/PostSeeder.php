<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make function to create 10 posts using loop method
        $numPosts = 10; //number of post created

        //setup progress bar
        $progressBar = $this->command->getOutput()->createProgressBar($numPosts);
        $progressBar->setFormat("Creating blog posts \n %current%%max% [%bar%] %percent:3s%%");

        //start progress bar 
        $progressBar->start();

        //create post factory
        for($i = 0; $i < $numPosts; $i++) {
            Post::factory()->create();
            $progressBar->advance();
        }
        
        
        $progressBar->finish();
        $this->command->line('');
    }
}
