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
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class trainDetailsAdd extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(train_details $target): iterable
    {
        return [
            'train_details'=>$target
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Add new Train Detail';
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
                Input::make('train_details.id')
                    ->type('number')
                    ->title('Train ID')
                    ->required(),

                Input::make('train_details.class1')
                ->type('number')
                ->title('Class 1'),

                Input::make('train_details.class2')
                ->type('number')
                ->title('Class 2'),
                
                Input::make('train_details.class3')
                ->type('number')
                ->title('Class 3'),

                 Button::make('Add')
                 ->method('add')
                 ->class('btn btn-primary'),
             ]),
        ];
    }

    public function add(train_details $train_details, Request $request)
    {   
        $findSameTrainRow = DB::select('select id FROM train_details WHERE id='.($request->get('train_details'))['id'].'');
        
        
        if(count($findSameTrainRow)>0){
            Alert::info('You already have train_details row with same train id');

            return redirect()->route('platform.traindetails');
        }
        
        else if($train_details->fill($request->get('train_details'))->save()){
            Alert::info('You have successfully added a new train_details row.');

            return redirect()->route('platform.traindetails');
        }
        Alert::info('Error!');

        return redirect()->route('platform.traindetails'); 
        
    }
}
