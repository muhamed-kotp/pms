<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Traits\Imageable;


class Webanner extends Model implements TranslatableContract
{
    use HasFactory , Translatable, Imageable;

    public $translatedAttributes = ['name','description'];
}
