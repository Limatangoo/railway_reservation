<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\train_details;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class trainDetailsEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public $traindetails;
    public function query(train_details $target): iterable
    {
        return [
            'traindetails'=>$target
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit the Train Details';
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
                Input::make('traindetails.id')
                     ->type('number')
                     ->title('Route ID')
                     ->readonly('readonly'),

 
                 Input::make('traindetails.class1')
                 ->type('number')
                 ->title('Class 1'),
                 
                 Input::make('traindetails.class2')
                 ->type('number')
                 ->title('Class 2'),

                 Input::make('traindetails.class3')
                 ->type('number')
                 ->title('City 3'),
 
                

                 Button::make('Edit')
                 ->method('update')
                 ->class('btn btn-primary')
                 ->canSee($this->traindetails->exists),
             ]),
        ];
        
    }
    public function update(train_details $train_details, Request $request)
    {
        
        $train_details->fill($request->get('traindetails'))->save();

        Alert::info('You have successfully edited the train details of Route '.$train_details->id.'');

        return redirect()->route('platform.traindetails');
    }
}
