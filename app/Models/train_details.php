<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
class train_details extends Model
{
    use HasFactory;
    use AsSource,Filterable;

    protected $fillable = [
        'id',
        'class1',
        'class2',
        'class3'
    ];

    protected $allowedSorts = [
        'id'
    ];
}
