<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{
    protected $guarder = [];
    use HasFactory;
    protected $fillable = [
        'title',
        'url',
        'body',
        'published_at',
        'excerpt',
        'category_id',
        // Agrega aquí '_token'
       
    ];
    //es para que tome el dato como instancia de carbon
    protected $dates = ['published_at']; 
   
        public function getRouteKeyName()
        {
          return 'url';
        }

        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        /**
         * The tags that belong to the Post
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function tags()
        {
            return $this->belongsToMany(Tag::class);
        }
        
        public function photos(){
          return $this->hasMany(Photo::class);
        }

        public function scopePublished($query)
        {
           
            $query->whereNotNull('published_at')
            ->where('published_at','<=',Carbon::now())
            ->latest('published_at');
        }

}
