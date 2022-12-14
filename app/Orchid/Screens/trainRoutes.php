<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Layouts\trainRoutesTable;
use App\Models\train_routes;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;

class trainRoutes extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
     public $train_routes;
    public function query(): iterable
    {
        return [

            'train_routes' => train_routes::filters()->defaultSort('id')->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'TrainRoutes';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('add new route')
                ->route('platform.trainrouteadd')
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
            trainRoutesTable::class 
        ];
    }
    public function remove(Request $request){
        $train_routes = new train_routes;
        $train_routes->where('id',$request->id)->delete();
        Alert::message('you have deleted route id: '.$request->id.'');
   }
}
