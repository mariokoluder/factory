<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use \Dimsav\Translatable\Translatable;


class Category extends Model
{
    use HasFactory;

    public $translatedAttributes = ['title'];

    public function meal(): HasOne
    {
        return $this->HasOne(Meal::class);
    }
}
