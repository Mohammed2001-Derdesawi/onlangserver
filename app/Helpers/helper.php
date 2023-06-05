<?php

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


 function findById($model,$id,$relations=[],$params=['*'],$count=[],$sum=[])
{
    $query = $model::with($relations)->select($params)->withCount($count);

    if (!empty($sum)) {
        $query->withSum($sum[0], $sum[1] ?? null);
    }

    return $query->findOrFail($id);


}




function storeImage($path, $file)
{
    $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs($path, $file, $imageName);
    return $imageName;
}

function editImage($path, $file , $oldImage)
{
    deleteImage($oldImage);

    $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs($path, $file, $imageName);
    return $imageName;
}

function deleteImage($oldImage)
{
    $exists = Storage::disk('public')->exists(substr($oldImage,8));



    if ($exists) {
        $exists = Storage::disk('public')->delete(substr($oldImage,8));
        return true;
    }
    return false;
}





