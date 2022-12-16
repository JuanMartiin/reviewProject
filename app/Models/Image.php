<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    protected $table = "image";
    
    protected $fillable = ['name'];
    
    function review() {
        return $this->belongsTo('App\Models\Review', 'idreview');
    }
    
    function takeImg($imgs){
        
    }
    
    function storeImg($imgs, $id){
        foreach($imgs as $img){
            $nameOg = $img->getClientOriginalName();
            $image = new Image();
            $image->name = $nameOg;
            $image->idreview = $id;
            $image->save();
            $img->storeAs('public/images' , $nameOg);
        }
    }
}
