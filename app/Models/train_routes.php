<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
class train_routes extends Model
{
    use HasFactory;

    use AsSource,Filterable;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
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

     /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'id'
    ];

    
}
