<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Class_;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];

    protected $fillable = [
        'title','description','content','image','published_at','category_id','user_id'
    ];

    /**
     * Delete post image
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /***
     * check if a post has tag
     *
     * @return bool
     */
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved',true);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at','<=',now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if(!$search)
        {
            return $query->approved()->published();
        }
        else
        {
            return $query->approved()->published()->where('title','LIKE',"%{$search}%");
        }

    }

}
