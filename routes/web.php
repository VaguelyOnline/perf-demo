<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	
	// view needs some data
	// average posts per user
	$users = App\User::getRecentUsersGraph();

	// use clockwork to time the event
	clock()->startEvent('event_name', 'Profiling average calc');
	$totalPosts = 0;
	$totalComments = 0;


	// calc average number of posts, and average
	// comments per user (aggregate of )
	foreach($users as $user)
	{
		$totalPosts += $user->posts->count();
		
		foreach ($user->posts as $post)
		{
			$totalComments += $post->comments->count();
		}
	}
	clock()->endEvent('event_name');

	$average = $users->count()
		? $totalPosts / $users->count()
		: 0;
	
	$averageComments = $users->count()
		? $totalComments / $users->count()
		: 0;
	
    return view('welcome', compact('users', 'average', 'averageComments'));
});
