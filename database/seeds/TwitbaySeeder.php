<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Comment;

class TwitbaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//     	DB::table('users')->truncate();
        DB::table('posts')->truncate();
		DB::table('comments')->truncate();
		
        // Create a bunch of users
        for ($i=0; $i < 500; $i++)
        	factory(App\User::class)->make()->save();

		
        // foreach user, create a random number of posts
        $users = User::all();
        foreach($users as $user)
        {
        	$numPosts = rand(1, 5);
        	for($i=0; $i < $numPosts; $i++)
        	{
        		// create a 'random' post, and link it to the user
        		$post = factory(App\Post::class)->make();
        		$post->user_id = $user->id;
        		$post->save();
        		
        		echo "\nCreated Post: " . $post->id;
        		
        		// foreach post, create a random number of comments
        		$numComments = rand(1, 5);
        		for($j=0; $j < $numComments; $j++)
        		{
        			// pick a random user, 
        			$randomUser = $users->random();
        			$comment = factory(App\Comment::class)->make();
        			
      				// link & save
        			$comment->user()->associate($randomUser);
        			$comment->post()->associate($post);
        			$comment->save();
        			
        			echo "\nCreated Comment: " . $comment->id;
        		}
        	}
        }
    }
}
