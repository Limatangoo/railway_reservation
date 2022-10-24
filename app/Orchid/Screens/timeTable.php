<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Layouts\timeTableLayout;
use App\Models\time_table;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;

class timeTable extends Screen
{   

    protected $target = 'time_table';
    /**
     * Query data.
     *
     * @return array
     */ 
    //public $time_table;

    public function query(): iterable
    {
        return [
            'time_table' => time_table::filters()->defaultSort('route_id')->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Time Table';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('add new time table')
                ->route('platform.timetableadd')
                ->icon('plus'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            timeTableLayout::class 
        ];
    }
    public function remove(Request $request){
        $time_table = new time_table;
        $time_table->where('id',$request->id)->delete();
        Alert::message('you have deleted the time table of route id: '.$request->route_id.'');
   }
}
