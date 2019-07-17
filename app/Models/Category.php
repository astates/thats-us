<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categories';

    use SoftDeletes;

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
