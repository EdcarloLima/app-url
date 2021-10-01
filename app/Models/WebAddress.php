<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebAddress extends Model
{
    use HasFactory;

    protected $table      = 'web_address';
    protected $primaryKey = 'id';
    public $timestamps    = true;
    protected $fillable   = [
        'url',
        'status_code',
        'visible',
        'content'
    ];
}
