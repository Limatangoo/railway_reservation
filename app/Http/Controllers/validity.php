<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\train_routes;
use App\Models\prices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class validity extends Controller
{
    public function routecheck(Request $request)
    {
        //date("Y-m-d")
         $data = $request->validate([
            'start_date' => 'required|date|after:today',
            'from_destination'=>'required',
            'to_destination'=>'required',
            'pax_count'=>'required|integer'
        ]);
            
        if(isset($request->validator) && $validator->fails()) {
            return Redirect::back()->withErrors($validator,['alltrains'=>'']);
        }
        $city1 = $request->from_destination;
        $city2 = $request->to_destination;
        $start_date = $request->start_date;
        $pax_count = (int)($request->pax_count);

        if($city1==$city2){
            return view('index',['alltrains'=>'origin and destination cannot be same']);
        }
        
        
        $results = DB::select('select * from train_routes where (city1 = "'.$city1.'" or city2 = "'.$city1.'" or city3 = "'.$city1.'"or city4 = "'.$city1.'"or city5 = "'.$city1.'"or city6 = "'.$city1.'"or city7 = "'.$city1.'"or city8 = "'.$city1.'"or city9 = "'.$city1.'"or city10 = "'.$city1.'") and (city1 = "'.$city2.'"or city2 = "'.$city2.'"or city3 = "'.$city2.'"or city4 = "'.$city2.'"or city5 = "'.$city2.'"or city6 = "'.$city2.'"or city7 = "'.$city2.'"or city8 = "'.$city2.'"or city9 = "'.$city2.'"or city10 = "'.$city2.'")');
        if(count($results)<=0){
            return view('index',['alltrains'=>'no trains found for your search']);
        }
        else{
           //print_r($results);
         
           $i=1;
           $m=0;
           $total_options = 0;
           $route_count = count($results);

           while($i<11){
              $result_1[$i-1] = data_get($results, '*.city'.$i);
              $x=1;

              while($x<=$route_count){
                $j=1;
                while($j<11){
                    $result_2[$j-1] = data_get($results, '*.city'.$j);
                    if($result_1[$i-1][$x-1]==$city1 && $result_2[$j-1][$x-1]==$city2 && $j>$i){
                        $routes[$m] = DB::select('select * from train_routes where city'.$i.'="'. $city1.'" and city'.$j.'="'. $city2.'"');
                        $route_ids[$m] = $routes[$m][0]->id; 
                        //dd($route_ids[$m]);
                        $seat_check[$m] = DB::select('select * from seat_checks where route_id = '.$route_ids[$m].' and date = "'.$start_date.'"');
                        //print(count($seat_check[$m]));
                        if(count($seat_check[$m])>0){
                        //dd($seat_check[$m]);
                        $time_check[$m] = DB::select('select * from time_tables where route_id = '.$route_ids[$m].'');
                        $prices_check[$m] = DB::select('select * from prices where route_id = '.$route_ids[$m].'');
                        $n=0;
                        $price=0;
                        $y=1;
                        for($y=$i;$y<$j;$y++){
                            $seat_count[$m][$n] = data_get($seat_check[$m], '*.city'.$y);
                            $price_array[$m][$n] =  data_get($prices_check[$m], '*.city'.$y)[0];
                            $start_time[$m] = data_get($time_check[$m], '*.city'.$i);
                            $end_time[$m] = data_get($time_check[$m], '*.city'.$j);
                            $price += $price_array[$m][$n];
                            $n++;
                          }
                        $total_price[$m] = $price;
                        $max_count[$m] = max($seat_count[$m]);
                       
                        
                        $train_id = $seat_check[$m][0]->train_id;
                        $train_type[$m] = DB::select('select * from train_details where id = '.$train_id);
                        $total_seats[$m] = $train_type[$m][0]->class1;
                        //dd($total_seats[$m]-$max_count[$m][0]);
                        if($end_time[$m][0]<$start_time[$m][0]){
                            $journey_end_date[$m] = date('Y-m-d',strtotime($start_date . ' +1 day'));
                            }
                        else{
                        $journey_end_date[$m] = $start_date;
                        } 
                        if($pax_count<=($total_seats[$m]-$max_count[$m][0])){
                          $total_options +=1;
                          //$seat_check[$m] = $seat_check[$m];
                          $avail_seats[$m] = $total_seats[$m] - $max_count[$m][0];
                          $m++;
                        }
                        
                        
                        }
                         
                        //dd($total_options);
                        //dd($seat_check[0][0]->date);
                      } 
                   $j++;
                }
                  
                  $x++;
              }
                  
              
              
             
              $i++;
           }
           //dd($m);
          //dd($seat_check);
          if($total_options>0){
            return view('index',['total_options'=> $total_options,'seat_check'=>$seat_check,'avail_seats'=>$avail_seats,'total_price'=>$total_price,'journey_end_date'=>$journey_end_date,'start_time'=>$start_time,'end_time'=>$end_time,'city1'=>$city1,'city2'=>$city2]);
          }
          else{
            return view('index',['alltrains'=>'Sorry! no tickets for that date']);
          }
          //dd($price_array[$i][$y][0]);
          //dd($avail_seats[0]->route_id);
          /*else{
            $avail_seats = $total_seats - $max_count;
            return view('index',['seat_check'=>$seat_check,'avail_seats'=>$avail_seats,'price'=>$price,'journey_end_date'=>$journey_end_date,'start_time'=>$start_time[0],'end_time'=>$end_time[0]]);
          }*/
          
         
           //return view('index',['seat_check'=>$seat_check]);
        }
        
        //return view('/index',['alltasks'=>$data]);
 
       
        
    }
}
