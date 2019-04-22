<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Importing Genre and Track model
use App\Genre;
use App\Track;

class SongController extends Controller
{
	public function searchForm() {
		// Connect to the database and get genres from the database
		$genre = new Genre();

		// This is equivalent to SELECT * FROM genres;
		//var_dump($genre->all());

		// Give the genre data to search form so it can be displayed in the dropdown menu.
		return view('search_form', [
			'genres' => $genre->all(),
			'username' => 'ttrojan'
		]);
	}

	public function search() {

		// Grab the user's input (track and genre)
		$track_name = request('track_name');
		$genre = request('genre');

		//var_dump($track_name);

		// Connect to the database and get search results from the database
		$track = new Track();

		// SELECT * FROM tracks WHERE genre = $genre
		$results = $track->select('tracks.name AS track_name', 'composer', 'genres.name AS genre');

		// Handle optional inputs (track name and genre) - WHERE 1=1 
		if( isset($track_name) && !empty($track_name) ) {
			$results = $results->where('tracks.name', 'LIKE' , '%' . $track_name .'%');
		}
		if( isset($genre) && !empty($genre) ) {
			$results = $results->where('tracks.genre_id', '=' , $genre);
		}

		// To get the name of genre, need to JOIN tracks table and genre table
		$results = $results->leftJoin('genres', 'tracks.genre_id', '=', 'genres.genre_id');

		return view('search_results', [
			'tracks' => $results->get()
		]);
	}
}








?>