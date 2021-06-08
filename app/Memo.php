<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    // use HasFactory;
    // ----- ここから追加する -----
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];
    // ----- ここまで追加する -----

}
