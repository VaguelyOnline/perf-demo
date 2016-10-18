<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	
	/**
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    
    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
