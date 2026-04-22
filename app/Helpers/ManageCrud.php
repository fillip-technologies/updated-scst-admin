<?php

namespace App\Helpers;

class ManageCrud
{
    public static function createdatas($model, array $data)
    {
        return $model::create($data);
    }

    public static function getAll($model)
    {
        return $model::orderBy('updated_at','desc')->paginate(10);
    }

    public static function singledata($model, $id)
    {
        return $model::findOrFail($id);
    }

    public static function updatedata($model, $id, $data)
    {
        $finddata = $model::findOrFail($id);
        $finddata->update($data);
        return $finddata;
    }

    public static function deletedata($model, $id)
    {
        $dataget = $model::findOrFail($id)->delete();
        return $dataget;
    }

    public static function querydataupdate($model, $id, $data)
    {
        $finddata = $model::where('school_id', $id)->firstOrFail();
        $finddata->update($data);
        return $finddata;
    }
}
