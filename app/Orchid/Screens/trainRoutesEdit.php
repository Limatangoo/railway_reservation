<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\train_routes;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class trainRoutesEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public $train_routes;
    public function query(train_routes $target): iterable
    {
        
        return [
            'train_routes'=>$target
        ];
    }
   
   
    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit the Train Route';
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
               Input::make('train_routes.id')
                    ->type('number')
                    ->title('Route ID')
                    ->readonly('readonly'),

                Input::make('train_routes.city1')
                ->type('text')
                ->title('City 1'),

                Input::make('train_routes.city2')
                ->type('text')
                ->title('City 2'),
                
                Input::make('train_routes.city3')
                ->type('text')
                ->title('City 3'),
                Input::make('train_routes.city4')
                ->type('text')
                ->title('City 4'),

                Input::make('train_routes.city5')
                ->type('text')
                ->title('City 5'),
                
                Input::make('train_routes.city6')
                ->type('text')
                ->title('City 6'),
                Input::make('train_routes.city7')
                ->type('text')
                ->title('City 7'),

                Input::make('train_routes.city8')
                ->type('text')
                ->title('City 8'),
                
                Input::make('train_routes.city9')
                ->type('text')
                ->title('City 9'),

                Input::make('train_routes.city10')
                ->type('text')
                ->title('City 10'),

                Button::make('Edit')
                ->method('update')
                ->class('btn btn-primary')
                ->canSee($this->train_routes->exists),
            ]),
        ];
    }

    public function update(train_routes $train_route, Request $request)
    {
        $mapped = Arr::map($request->get('train_routes'), function ($value, $key) {
            return ucfirst($value);
        });
        $train_route->fill($mapped)->save();

        Alert::info('You have successfully edited.');

        return redirect()->route('platform.trainroutes');
    }
}
