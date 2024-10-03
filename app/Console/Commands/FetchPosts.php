<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;

class FetchPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        if ($response->successful()) {
            $posts = $response->json();

            foreach ($posts as $post) {
                Post::updateOrCreate(
                    ['post_id' => $post['id']],
                    ['title' => $post['title'],
                    'body' => $post['body'],
                    'user_id' => $post['userId']],
                );
            }

            $this->info('Posts retrieved and stored to database.');
        } else {
            $this->error('Failed to retrieve posts.');
        }
    }
}
