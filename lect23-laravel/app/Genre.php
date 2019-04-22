<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{	
	// Defining the table of the DB - this links the database table to laravel's model 
	protected $table = 'genres';
	protected $primaryKey = 'genre_id';
}

?>