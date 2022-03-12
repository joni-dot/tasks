<?php

namespace App\Models\Traits;

trait HasStaticTableName
{
    public static function tableName()
    {
        return with(new static)->getTable();
    }
}
