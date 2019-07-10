<?php

namespace App\Models;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'updated' => PostUpdated::class,
        'deleted' => PostDeleted::class,
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'thumbnail_path',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
