<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
 
    use HasFactory;
    protected $fillable=['body'];
  protected $gureded=[];
  public function commentable(): MorphTo
  {
      return $this->morphTo();
  }

}
