<?php
 namespace App\Models;
 use Illuminate\Database\Eloquent\Model;
 
 class UserJob extends Model{
     
    protected $table = 'tbluserjob';
    
    protected $fillable = [
        'id','user_id','age','gender'
    ];


    public $timestamps = false;

    protected $primarykey = 'id';
 }