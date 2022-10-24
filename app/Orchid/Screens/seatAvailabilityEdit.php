<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\seat_checks;
use App\Models\train_details;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Toast;
class seatAvailabilityEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public $seat_checks;
    public function query(seat_checks $target): iterable
    {
        return [
            'seat_checks'=>$target
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'seatAvailabilityEdit';
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
                Input::make('seat_checks.route_id')
                     ->type('number')
                     ->title('Route ID')
                     ->readonly('readonly'),

                Input::make('seat_checks.train_id')
                ->type('number')
                ->title('Train ID'),

                Input::make('seat_checks.date')
                ->title('Date')
                ->format('Y-m-d')
                ->readonly('readonly'),
 
                 Input::make('seat_checks.city1')
                 ->type('number')
                 ->title('City 1')
                 ->readonly('readonly'),
 
                 Input::make('seat_checks.city2')
                 ->type('number')
                 ->title('City 2')
                 ->readonly('readonly'),
                 
                 Input::make('seat_checks.city3')
                 ->type('number')
                 ->title('City 3')
                 ->readonly('readonly'),

                 Input::make('seat_checks.city4')
                 ->type('number')
                 ->title('City 4')
                 ->readonly('readonly'),
 
                 Input::make('seat_checks.city5')
                 ->type('number')
                 ->title('City 5')
                 ->readonly('readonly'),
                 
                 Input::make('seat_checks.city6')
                 ->type('number')
                 ->title('City 6')
                 ->readonly('readonly'),

                 Input::make('seat_checks.city7')
                 ->type('number')
                 ->title('City 7')
                 ->readonly('readonly'),
 
                 Input::make('seat_checks.city8')
                 ->type('number')
                 ->title('City 8')
                 ->readonly('readonly'),
                 
                 Input::make('seat_checks.city9')
                 ->type('number')
                 ->title('City 9')
                 ->readonly('readonly'),
 
                 Input::make('seat_checks.city10')
                 ->type('number')
                 ->title('City 10')
                 ->readonly('readonly'),
 
                 Button::make('Edit')
                 ->method('update')
                 ->class('btn btn-primary')
                 ->canSee($this->seat_checks->exists),
             ]),
        ];
    }
    public function update(seat_checks $seat_checks, Request $request)
    {   
        $exp = ($request->get('seat_checks'))['train_id'];
        
        $maxSeatOld = DB::select('select city1,city2,city3,city3,city4,city5,city6,city7,city8,city9,city10 FROM seat_checks WHERE id='.$seat_checks->id.'');
        
        
        $i=0;
        $maxSeatOldVal=0;
        while($i<10){
            $maxSeatOldNew[$i] = data_get($maxSeatOld, '*.city'.($i+1));
            if($maxSeatOldNew[$i][0]>$maxSeatOldVal){
                $maxSeatOldVal = $maxSeatOldNew[$i][0];
            }
            
            $i++;
        }
        //dd(($request->get('seat_checks'))['date']);
        //finding the time grudge (prevents from same train for routes with same time)
        $timeGrudgeFound = 0;
        $route_id = DB::select('select route_id FROM seat_checks WHERE train_id='.($request->get('seat_checks'))['train_id'].' AND date="'.($request->get('seat_checks'))['date'].'"');
        $route_id_count = count($route_id);
        //dd($route_id[1]->route_id);
        if($route_id_count>1){
           $i=0;
           while($i<$route_id_count){
            $time_table[$i]= DB::select('select city1,city2,city3,city3,city4,city5,city6,city7,city8,city9,city10 FROM time_tables WHERE route_id='.$route_id[$i]->route_id.'');
            $i++;
           }
           //dd((data_get($time_table[0], '*.city'.(3)))[0]);
           $time_table_count = count($time_table);
           if($time_table_count>1){
               $i=0;
               $r1max=0;
               $r2max=0;
               while($i<($time_table_count-1)){
                $x=1;
                 while($x<11){
                     if((data_get($time_table[$i], '*.city'.($x)))[0] > $r1max){
                        $r1max = (data_get($time_table[$i], '*.city'.($x)))[0];
                     }
                     if((data_get($time_table[$i+1], '*.city'.($x)))[0] > $r2max){
                        $r2max = (data_get($time_table[$i+1], '*.city'.($x)))[0];
                     }
                     $x++;
                 }
                if(($r1max < $time_table[$i+1][0]->city1) || ($r2max < $time_table[$i][0]->city1)){
                    $timeGrudgeFound=0;
                }
                else{
                    $timeGrudgeFound+=1;
                }

                
                $i++;
               }
           }
           
        } 
        //dd("15:20:00">"09:30:00");
        //dd($timeGrudgeFound);
        $maxSeatNew = DB::select('select class1 FROM train_details WHERE id='.($request->get('seat_checks'))['train_id'].'');
        $maxSeatNewVal = $maxSeatNew[0]->class1;
       
        if($maxSeatOldVal > $maxSeatNewVal){
            Alert::info('Current passenger bookings exceeds the maximum capacity of the train you re selected');
        }
        if($timeGrudgeFound>0){
            Alert::info('Train is assigned to different route at the same time');
        }
        else{
            $seat_checks->fill($request->get('seat_checks'))->save();

            Alert::info('You have successfully edited the train id of  '.$seat_checks->id.'');
    
            return redirect()->route('platform.seatavailability');
        }
        
    }
}
