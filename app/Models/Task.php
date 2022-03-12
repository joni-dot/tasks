<?php

namespace App\Models;

use App\Models\Traits\HasStaticTableName;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use HasStaticTableName;

    /** @var array */
    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TaskFactory::new();
    }
}
