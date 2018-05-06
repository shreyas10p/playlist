<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\User;
use App\Song;
use App\Tag;
use App\TagMap;
use Auth;
use App\Helpers\Response;

class TagController extends Controller
{





    public function getTags($id) {
        $tags = new TagMap();
        $tagInfo = $tags->enlistByPlaylistId($id);
        return $tagInfo;
    }



    public function delete($id){
        
        $playlist = Playlist::find($id);
        if($playlist){
            $deleted = $playlist->delete();
            if($deleted){
                Response::write(200, "playlist deleted successfully", null, null);
            } else {
                Response::write(401, 'failed to delete playlist', null , null);
            }
        } else {
            Response::write(401, 'failed to delete playlist', null , null);
        }
    }


}
