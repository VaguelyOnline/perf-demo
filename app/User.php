<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
	
    
    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

	/**
	 * Returns the cached recent users
	 */
    public static function getRecentUsersGraph()
    {
    	$users = Cache::remember('users', 1, function () {
    		$since = \Carbon\Carbon::now()->subWeek(1);
    		
    		return User::where('created_at', '>', $since)
	    		->orderBy('id', 'asc')
	    		->with('posts.comments')
	    		->limit(100)
	    		->get();
    	});
    	
    	
    	
		return $users;
    }
    
}
