<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Models\prices;
use App\Models\train_routes;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Actions\Button;
use Illuminate\Support\Arr;

class pricesTableAdd extends Screen
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
        return 'pricesTableAdd';
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
                    ->required(),

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

 
                 Button::make('Add')
                 ->method('add')
                 ->class('btn btn-primary'),
             ]),
        ];
    }

    public function add(prices $prices, Request $request)
    {   
        $findSamePriceRow = DB::select('select route_id FROM prices WHERE route_id='.($request->get('prices'))['route_id'].'');
        $findRouteId = DB::select('select id FROM train_routes WHERE id='.($request->get('prices'))['route_id'].'');
        
        if(count($findSamePriceRow)>0){
            Alert::info('You already have prices row with same route_id');

            return redirect()->route('platform.pricestable');
        }
        if(count($findRouteId)<1){
            Alert::info('First You need to add a route deatails for route id: '.($request->get('prices'))['route_id'].'');

            return redirect()->route('platform.pricestable');
        }
        
        else if($prices->fill($request->get('prices'))->save()){
            Alert::info('You have successfully added a new prices row.');

            return redirect()->route('platform.pricestable');
        }
        Alert::info('Error!');

        return redirect()->route('platform.pricestable'); 
        
    }
}
