<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\time_table;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class timeTableEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public $time_table;
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
        return 'Edit the time table';
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
                     ->readonly('readonly'),
 
                 Input::make('time_table.city1')
                 ->type('time')
                 ->title('City 1'),
 
                 Input::make('time_table.city2')
                 ->type('time')
                 ->title('City 2'),
                 
                 Input::make('time_table.city3')
                 ->type('time')
                 ->title('City 3'),
                 Input::make('time_table.city4')
                 ->type('time')
                 ->title('City 4'),
 
                 Input::make('time_table.city5')
                 ->type('time')
                 ->title('City 5'),
                 
                 Input::make('time_table.city6')
                 ->type('time')
                 ->title('City 6'),
                 Input::make('time_table.city7')
                 ->type('time')
                 ->title('City 7'),
 
                 Input::make('time_table.city8')
                 ->type('time')
                 ->title('City 8'),
                 
                 Input::make('time_table.city9')
                 ->type('time')
                 ->title('City 9'),
 
                 Input::make('time_table.city10')
                 ->type('time')
                 ->title('City 10'),
 
                 Button::make('Edit')
                 ->method('update')
                 ->class('btn btn-primary')
                 ->canSee($this->time_table->exists),
             ]),
        ];
    }

    public function update(time_table $time_table, Request $request)
    {
        
        $time_table->fill($request->get('time_table'))->save();

        Alert::info('You have successfully edited the time table of Route '.$time_table->route_id.'');

        return redirect()->route('platform.timetable');
    }
}
