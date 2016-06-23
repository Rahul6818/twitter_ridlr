<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Tweet extends Model

{

	protected $fillable =[

		'content','img_url','vid_url','user_id',

	];

	protected $table = "tweets";

}

?>
