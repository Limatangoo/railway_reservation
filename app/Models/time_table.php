<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class time_table extends Model
{
    use HasFactory;

    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'route_id',
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
}
