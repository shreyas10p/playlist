<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    protected $table='songs';

     /**
     * Search songs table by playlistId
     *
     * @return songs 
     */
    public function enlistByPlaylistId($playlistId){
        $songs = DB::table("songs")->orderBy('id', 'desc')->where('playlistId',$playlistId)->get();
        return $songs;

    }

     /**
     * Search songs table by playlistId and songUrl
     *
     * @return songs 
     */
    public function getSongUrl($playlistId,$songUrl){
    	 $songs = DB::table("songs")->where('playlistId',$playlistId)->where('songUrl',$songUrl)->get();
        return $songs;
    }
}
