<?php

namespace App\Models;

use Request;
use App\Models\User;
use App\Models\Image;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    use HasFactory, Searchable    ;

    protected $fillable = ['task_name','user_id','manger_id'];

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function images()
    {
        return $this->morphMany('App\Models\Image','imageable');
    }

    public static function searchTask(){
      // dd(Request::get('task_name'));
        $tasks=Self::select('tasks.*');
             // dd(Request::get('task_name'));

        if(!empty(Request::get('task_name'))){
            $tasks=$tasks->where('task_name','like','%'.Request::get('task_name').'%');
        }
        if(!empty(Request::get('date'))){
            $return=$return->whereDate('created_at','=',Request::get('date'));
        }
        //$tasks=$tasks->orderBy('id','desc');
        return $tasks;
    }
    

    public function toSearchableArray() : array
{
    return [
        'task_name'=>$this->task_name,
        'created_at'=>$this->created_at,
    ];
}


}
