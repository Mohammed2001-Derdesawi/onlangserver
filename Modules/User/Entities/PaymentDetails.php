<?php

namespace Modules\User\Entities;

use Modules\Course\Entities\Course;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{

    protected $fillable = ['payment_id' , 'course_id' ,'price'];

    protected $with = ['course'];
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id' , 'id');
    }





}
