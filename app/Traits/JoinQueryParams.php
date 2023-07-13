<?php


namespace App\Traits;

trait JoinQueryParams
{

    function joinTable($model, $joinRelation)
    {
        $table = explode(",", $joinRelation);
        foreach ($table as  $value) {
            # code...
            if (method_exists($model, $value)) {

                echo $model::with($value)->get();
            }
            else 
            {
                echo $model::all();
            }
        }
    }
}
