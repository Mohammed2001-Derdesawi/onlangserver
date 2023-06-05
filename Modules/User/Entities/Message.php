<?php

namespace Modules\User\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Message extends Model
{
    use Loggable;
    protected $fillable =  ['sender_type', 'sender_id', 'receiver_type', 'receiver_id', 'title','message','read_at'];

    public function sender()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->morphTo();
    }

    public function scopeSearch($q){
      $search=request()->search;

      if($search){
        $q->whereHasMorph('sender',[User::class],function( Builder $q) use($search){
          $q->where('name','LIKE','%'.$search.'%');
        })->orwhereHasMorph('receiver',[User::class],function(Builder $q) use($search){
            $q->where('name','LIKE','%'.$search.'%');

        });
      }
    }
}
