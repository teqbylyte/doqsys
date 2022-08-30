<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class General
{
    /**
     * These are categorized names of uploaded documents
     */
    const  DOC_TYPES = ['image', 'pdf', 'docs', 'zip', 'others'];

    /**
     * Check the model passed if the string value to be input in the specified column already exists.
     *
     * If it does, return the count value added to the string else return the original string value.
     *
     *
     * @param Model $model
     * @param string $column
     * @param string $value
     * @param int|null $super_folder If the name is to be nested in another folder
     * @return string
     */
    public static function generateName(Model $model, string $column, string $value, int|null $super_folder = null): string
    {
        $name_exists = $model::query()->where($column, $value)
            ->where('folder_id', $super_folder)
            ->exists();

        if ($name_exists) {
//           Increase the name by 1 check if it exists until it is false;
            $n = 1;

            while ($model::query()->where($column, "$value $n")
                ->where('folder_id', $super_folder)
                ->exists()
            ) $n++;

//            return the final name + increment
            return "$value $n";
        }

        else return  $value;
    }

    public static function getAllPermissions(): array
    {
        return Permission::query()->pluck('name')->toArray();
    }

}
