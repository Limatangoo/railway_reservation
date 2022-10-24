<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Layouts\pricesTableLayout;
use App\Models\prices;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;

class pricesTable extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'prices' => prices::filters()->defaultSort('route_id')->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Prices Table';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('add new prices for a route')
                ->route('platform.pricestableadd')
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
            pricesTableLayout::class 
        ];
    }

    public function remove(Request $request){
        $prices = new prices;
        $prices->where('id',$request->id)->delete();
        Alert::message('you have deleted the price details of route id: '.$request->route_id.'');
   }
}
