<?php
namespace App\Http\Traits;
use Illuminate\Database\Eloquent\Model;
trait GlobalFunctions
{
    public function saveMany(Model &$model, string $relationship, array $data)
    {
        foreach($data as $relation_id) {
            if(!$model->$relationship || !$model->$relationship->contains($relation_id))
                $model->$relationship()->attach($relation_id);
        }
    }
}
