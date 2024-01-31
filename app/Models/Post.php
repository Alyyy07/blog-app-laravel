<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;
    
    // protected $fillable=['title','slug','excerpt','body'];
    protected $guarded = ['id'];
    protected $with = ['category','author'];

    //relasi
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeSearch($query,array $filters){
        $query->when($filters['search'] ?? false,function($query,$search){ //isset($filters['search'])? $filters['search'] : false
            return $query->where('title','like','%'.$search.'%')
            ->orWhere('body','like','%'.$search.'%');
        })
        ->when($filters['category'] ?? false,function($query,$category){
            return $query->whereHas('category',function($query) use ($category){
                $query->where('slug',$category);
            });
        })
        ->when($filters['author'] ?? false,fn($query,$author)=> //arrow function version
            $query->whereHas('author',fn($query)=>
                $query->where('username',$author)
            )
        );
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable():array{
        return [
            'slug'=>[
                'source'=>'title'
            ]
        ];
    }
}
