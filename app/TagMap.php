<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagMap extends Model
{
    protected $table='tagmaps';

     /**
     * Search tagmaps table by playlistId
     *
     * @return songs 
     */
    public function enlistByPlaylistId($playlistId){
        $tag = DB::table("tagmaps")->where('playlistId',$playlistId)->get();
        return $tag;

    }

     /**
     * Search tagmaps table by tagId
     *
     * @return songs 
     */
     public function enlistByTagId($tagId){
        $tag = DB::table("tagmaps")->where('tagId',$tagId)->get();
       	return $tag;

    }



}
