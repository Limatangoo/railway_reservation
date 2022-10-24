<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class seat_checks extends Model
{
    use HasFactory;
    use AsSource,Filterable;

    protected $fillable = [
        'route_id',
        'train_id',
        'date',
        'city1',
        'city2',
        'city3',
        'city4',
        'city5',
        'city6',
        'city7',
        'city8',
        'city9',
        'city10'
    ];

    protected $allowedSorts = [
        'route_id','train_id','date'
    ];
}
