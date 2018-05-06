<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    protected $table='playlists';
	protected $dates = ['deleted_at'];
	// use SoftDeletes;

    /**
     * Search playlist table by userId
     *
     * @return playlist 
     */
    public function enlistByUserId($userId){
        $playlists = DB::table("playlists")->orderBy('id', 'desc')->where('userId',$userId)->get();
        return $playlists;

    }

    /**
     * Search playlist table by userId and playlistName
     *
     * @return playlist 
     */
    public function enlistByName($playlistName,$userId){
    	$playlists = DB::table("playlists")->where('playlistName',$playlistName)->where('userId',$userId)->get();
        return $playlists;
    }

     /**
     * Search playlist table by playlistId
     *
     * @return playlist 
     */
    public function enlistByPlaylistId($playlistId){
    	$playlist = DB::table("playlists")->where('id',$playlistId)->get();
    	return $playlist;
    }
}
