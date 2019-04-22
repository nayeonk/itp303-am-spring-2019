<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{	
	// This info is from our database
	protected $table = 'tracks';
	protected $primaryKey = 'track_id';
}

?>