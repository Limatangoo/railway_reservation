<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Models\time_table;
use App\Models\train_routes;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Actions\Button;
use Illuminate\Support\Arr;
class timeTableAdd extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(time_table $target): iterable
    {
        return [
            'time_table'=>$target
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Add a new time table';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('time_table.route_id')
                    ->type('number')
                    ->title('Route ID')
                    ->required(),

                Input::make('time_table.city1')
                ->type('time')
                ->title('City 1')
                ->help('Start time from city1'),

                Input::make('time_table.city2')
                ->type('time')
                ->title('City 2')
                ->help('Arrive time to city2'),
                
                Input::make('time_table.city3')
                ->type('time')
                ->title('City 3')
                ->help('Arrive time to city3'),

                Input::make('time_table.city4')
                ->type('time')
                ->title('City 4')
                ->help('Arrive time to city4'),

                Input::make('time_table.city5')
                ->type('time')
                ->title('City 5')
                ->help('Arrive time to city5'),
                
                Input::make('time_table.city6')
                ->type('time')
                ->title('City 6')
                ->help('Arrive time to city6'),

                Input::make('time_table.city7')
                ->type('time')
                ->title('City 7')
                ->help('Arrive time to city7'),

                Input::make('time_table.city8')
                ->type('time')
                ->title('City 8')
                ->help('Arrive time to city8'),
                
                Input::make('time_table.city9')
                ->type('time')
                ->title('City 9')
                ->help('Arrive time to city9'),

                Input::make('time_table.city10')
                ->type('time')
                ->title('City 10')
                ->help('Arrive time to city10'),

 
                 Button::make('Add')
                 ->method('add')
                 ->class('btn btn-primary'),
             ]),
        ];
    }
    public function add(time_table $time_table, Request $request)
    {
        $findSameTimetableRow = DB::select('select route_id FROM time_tables WHERE route_id='.($request->get('time_table'))['route_id'].'');
        $findRouteId = DB::select('select id FROM train_routes WHERE id='.($request->get('time_table'))['route_id'].'');
        
        if(count($findSameTimetableRow)>0){
            Alert::info('You already have time table row with same route_id');

            return redirect()->route('platform.timetable');
        }
        if(count($findRouteId)<1){
            Alert::info('First You need to add a route deatails for route id: '.($request->get('time_table'))['route_id'].'');

            return redirect()->route('platform.timetable');
        }

        else if($time_table->fill($request->get('time_table'))->save()){
            Alert::info('You have successfully added a new time table.');

            return redirect()->route('platform.timetable');
        }
        Alert::info('Error!');

        return redirect()->route('platform.timetable'); 
        
    }

}
