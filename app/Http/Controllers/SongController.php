<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\User;
use App\Song;
use App\Tag;
use App\TagPlaylist;
use Auth;
use App\Helpers\Response;


class SongController extends Controller
{

   /**
     * get the playlist by playlist id
     *
     * @return to view song
     */
    public function show($id)
    {
        $playlist = new Playlist();
        $playlistDetail = $playlist->enlistByPlaylistId($id);
        return view('songs',['playlist'=>$playlistDetail]);
    }
  
    /**
     * get the songs of the playlist
     *
     * @return playlistSongs 
     */
    
    public function getSongs($id)
    {
      $songs = new Song();
      $playlistSongs = $songs->enlistByPlaylistId($id);
      return $playlistSongs;
    }
   
    /**
     * Add song to the playlist
     *
     * @return JSON response 
     */
    public function addSong(Request $request) {


    $song = json_decode($request->getContent());
    if(array_key_exists("playlistId", $song)){
        $playlistId = $song->playlistId;
    } 

    if(array_key_exists("songName", $song)){
        $name = $song->songName;
    } 

    if(array_key_exists("songUrl", $song)){
        $songUrl = $song->songUrl;
    } 


    $song = new Song();

    $songExists = $song->getSongUrl($playlistId,$songUrl);
    if($songExists){
        Response::write(401, 'songExists', '', null);
    } else{
        $song->songName = $name;
        $song->playlistId = $playlistId;
        $song->songUrl = $songUrl;
        $playlistInsert = $song->save();
            if($playlistInsert){
                Response::write(200, 'successfully added song', '', null);
            } else{
                Response::write(401, 'song addition failed', '', null);
            }
        }  

    }

    public function delete($id){
        
        $song = Song::find($id);
        if($song){
            $deleted = $song->delete();
            if($deleted){
                Response::write(200, "song deleted successfully", null, null);
            } else {
                Response::write(401, 'failed to delete song', null , null);
            }
        } else {
            Response::write(401, 'failed to delete song', null , null);
        }
    }


}
