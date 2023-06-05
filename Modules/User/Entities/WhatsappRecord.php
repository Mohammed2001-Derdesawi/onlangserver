<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Course\Entities\Teacher;

class WhatsappRecord extends Model
{
    protected $fillable = [  'id' , 'unique_Id' , 'teacher_Id' ];
      protected $table ='whatsapp_record';

    public function teacher(){

        return $this->belongsTo(Teacher::class , 'teacher_id' , ' id' );
    }
    public function user(){

        return $this->belongsTo(User::class , 'unique_Id' , ' id' );
    }

}
