<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $table='tags';

     /**
     * Search tag table by Tagname
     *
     * @return tag 
     */
    public function enlistByTagName($tagName){
        $tag = DB::table("tags")->where('tagName',$tagName)->first();
        return $tag;

    }


}
