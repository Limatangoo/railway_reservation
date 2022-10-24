<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\prices;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Toast;

class pricesTableEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public $prices;
    public function query(prices $target): iterable
    {
        return [
            'prices'=>$target
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'pricesTableEdit';
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
                Input::make('prices.route_id')
                     ->type('number')
                     ->title('Route ID')
                     ->readonly('readonly'),

 
                 Input::make('prices.city1')
                 ->type('number')
                 ->title('City 1'),
 
                 Input::make('prices.city2')
                 ->type('number')
                 ->title('City 2'),
                 
                 Input::make('prices.city3')
                 ->type('number')
                 ->title('City 3'),

                 Input::make('prices.city4')
                 ->type('number')
                 ->title('City 4'),
 
                 Input::make('prices.city5')
                 ->type('number')
                 ->title('City 5'),
                 
                 Input::make('prices.city6')
                 ->type('number')
                 ->title('City 6'),

                 Input::make('prices.city7')
                 ->type('number')
                 ->title('City 7'),
 
                 Input::make('prices.city8')
                 ->type('number')
                 ->title('City 8'),
                 
                 Input::make('prices.city9')
                 ->type('number')
                 ->title('City 9'),
 
                 Input::make('prices.city10')
                 ->type('number')
                 ->title('City 10'),

                 Button::make('Edit')
                 ->method('update')
                 ->class('btn btn-primary')
                 ->canSee($this->prices->exists),
             ]),
        ];
    }

    public function update(prices $prices, Request $request)
    {
        
        $prices->fill($request->get('prices'))->save();

        Alert::info('You have successfully edited the prices table of Route '.$prices->route_id.'');

        return redirect()->route('platform.pricestable');
    }
}
