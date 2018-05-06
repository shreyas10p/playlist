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

class PlaylistController extends Controller
{

    /**
     * get the playlist of user by userId
     *
     * @return userPlaylists 
     */
    public function show($id) {
        $playlist = new Playlist();
        $userPlaylists = $playlist->enlistByUserId($id);
        return $userPlaylists;
    }
    
    /**
     * Get playlist by playlistId
     *
     * @return playlistInfo 
     */
    public function getPlaylist($id) {
        $playlist = new Playlist();
        $playlistInfo = $playlist->enlistByPlaylistId($id);
        return $playlistInfo;
    }

    /**
     * Create playlist for the user
     *
     * @return JSON response 
     */
    public function createPlaylist(Request $request) {

        $playlist = json_decode($request->getContent());
        if(array_key_exists("userId", $playlist)){
            $userId = $playlist->userId;
        }
        if(array_key_exists("name", $playlist)){
            $name = $playlist->name;
        } 
        if(array_key_exists("tags", $playlist)){
            $tags = $playlist->tags;
        }

        if(array_key_exists("playlistId", $playlist)) {
            $playlistId = $playlist->playlistId;
        }

        $tagsArray = explode(',', $tags);
        if($playlistId){
            $playlist = Playlist::find($playlistId);
            $playlistExists = 1;
        } else{
            $playlist = new Playlist();
            $playlistExists = $playlist->enlistByName($name,$userId);
            if($playlistExists){
                Response::write(401, 'Playlist with same name already exists', '', null);
            } 
        }
        
            $playlist->userId = $userId;
            $playlist->playlistName = $name;
            $playlist->tags = $tags;
            $playlistInsert = $playlist->save();
            if($playlistInsert){
                $tagMapInsert = $this->storeTags($tagsArray,$playlist);
                if($tagMapInsert){
                    Response::write(200, 'Playlist created successfully', '', null);
                } else{
                    Response::write(401, 'Tag creation failed', '', null);
                }

            } else{
                Response::write(401, 'Playlist creation failed', '', null);
            }
        
    }
    
    /**
     * Store tags for the user playlist
     *
     * @return boolean tagMapInsert 
     */
    public function storeTags($tags,$playlistInsert) {
        
        foreach($tags as $tag){
            $tagObject = new Tag();
            $tagDetail = $this->checkTag($tag,$tagObject);
            if($tagDetail){
                $tagMapInsert = $this->storeTagMap($tagDetail,$playlistInsert);
               
            } else{
                $tagObject->tagName = $tag;
                $tagInsert = $tagObject->save();
                if($tagInsert){
                    $tagMapInsert = $this->storeTagMap($tagObject,$playlistInsert);
                   
                }
            }
        }
        return $tagMapInsert;
    }
    
    /**
     * Store the tags info in TagMap table
     *
     * @return boolean tagMapInsert 
     */
    public function storeTagMap($tagDetail,$playlistInsert){
        $tagId = $tagDetail->id;
        $playlistId = $playlistInsert->id;
        $tagMap = new TagMap();
        $tagMap->playlistId = $playlistId;
        $tagMap->tagId = $tagId;
        $tagMapInsert = $tagMap->save();
        return $tagMapInsert;
    }
    
    /**
     * Check if tags already exists in tag table
     *
     * @return tagDetail 
     */
    public function checkTag($tag,$tagObject){
        $tagDetail = $tagObject->enlistByTagName($tag);
        return $tagDetail;
    }
    
    /**
     * Delete the playlist for the user
     *
     * @return JSON response
     */
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
