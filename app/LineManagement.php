<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineManagement extends Model
{
    protected $table = 'top1bwl_line_management';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'line_friend_link',
        'fb_friend_link',
    ];
}
