<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;



class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_user', 
        'post_category_id', 
        'name', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'post_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'post_category_id');
    }
}
