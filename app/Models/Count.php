<?php

namespace App\Models;

use App\Models\Traits\HasStaticTableName;
use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    use HasStaticTableName;

    /** @var array */
    protected $guarded = ['id'];
}
