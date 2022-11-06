<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Posts extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'posts';

    protected $primary_key = 'id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'title',
        'img',
        'body',
        'comment_id',
        'uploaded_at',
    ];

    protected $hidden = [
        'id',
    ];


}
