<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booking;
use App\Models\seat_checks;
use App\Models\time_table;
use App\Models\train_routes;
use App\Models\traveller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;

class bookingController extends Controller


{
    public function bookingIndex(Request $request){
        
        $seat_check_id = $request->seat_check_id;
        $pax_count = $request->pax_count;
        $city1 = $request->city1;
        $city2 = $request->city2;
        $total_price = $request->total_price;

        $seat_check = DB::select('select * from seat_checks where id = '.$seat_check_id.'');
        
        
        $route_id = $seat_check[0]->route_id;
        $train_id = $seat_check[0]->train_id;
        $date = $seat_check[0]->date;
        $train_details = DB::select('select class1 from train_details where id = '.$train_id.'');

        $i=1;
        while($i<11){
           if(DB::select('select city'.$i.' from train_routes where city'.$i.' = "'.$city1.'"AND id='.$route_id.'')){
              $city1_index = $i;
           }
           if(DB::select('select city'.$i.' from train_routes where city'.$i.' = "'.$city2.'"AND id='.$route_id.'')){
            $city2_index = $i;
           }
           $i++;
        }
        $city1_index = 'city'.$city1_index;
        $city2_index = 'city'.$city2_index;

        $time1 = (DB::select('select '.$city1_index.' from time_tables where route_id = '.$route_id.''))[0]->$city1_index;
        $time2 = (DB::select('select '.$city2_index.' from time_tables where route_id = '.$route_id.''))[0]->$city2_index;
        //dd($city1_index);
        return view('traveller/index',['seat_check_id'=>$seat_check_id,'pax_count'=>$pax_count,'city1'=>$city1,'city2'=>$city2,'total_price'=>$total_price,'date'=>$date,'time1'=>$time1,'time2'=>$time2]);
    }
    
    public function bookingCheck(Request $request){
        $data = $request->validate([
            'inputName' => 'required',
            'inputEmail'=>'required|email',
            'inputTp'=>'required|max_digits:10',
        ]);
        if(isset($request->validator) && $validator->fails()) {
            return Redirect::back()->withErrors($validator,['bookingError'=>'']);
        }
        $inputName = $request->inputName;
        $inputEmail = $request->inputEmail;
        $inputTp = $request->inputTp;
        $pax_count = $request->inputPaxCount;
        $seat_check_id = $request->inputSeatCheckId;
        $city1 = $request->inputCity1;
        $city2 = $request->inputCity2;
        $date = $request->inputDate1;
        $total_price = $request->inputTotalAmount;
        $time1 = $request->inputTime1;
        $time2 = $request->inputTime2;

        if(count(DB::select('select id from travellers where email = "'.$inputEmail.'"'))<1){
           
            DB::table('travellers')->insert([
                'email' => $inputEmail,
                'name' => $inputName,
                'telephone' => $inputTp
            ]);
        }
        $seat_check = DB::select('select * from seat_checks where id = '.$seat_check_id.'');
        $route_id = $seat_check[0]->route_id;
        $train_id = $seat_check[0]->train_id;
        $i=1;
        while($i<11){
           if(DB::select('select city'.$i.' from train_routes where city'.$i.' = "'.$city1.'"AND id='.$route_id.'')){
              $city1_index = $i;
           }
           if(DB::select('select city'.$i.' from train_routes where city'.$i.' = "'.$city2.'"AND id='.$route_id.'')){
            $city2_index = $i;
           }
           $i++;
        }
        $i=0;
        $y = $city1_index;
        while($y<$city2_index){
            $seat_count[$i] = data_get($seat_check, '*.city'.$y);
            $y++;
            $i++;
            }
        $max_seat_count = max($seat_count)[0];
        //dd($max_seat_count[0]);
        $train_type = DB::select('select * from train_details where id = '.$train_id);
        $total_seats = $train_type[0]->class1;   
        if($total_seats<($max_seat_count+$pax_count)){
            //return redirect('/');
            //return redirect()->route('/index', ['alltrains'=>'Allowable passenger limit for the journey exceeded, please select another day or lower the passengers']);
        }
        else{
            $travellerDetails = DB::select('select id from travellers where email = "'.$inputEmail.'"');
            $travellerId = $travellerDetails[0]->id;
            $timestamp = date('Y-m-d h:i:s', time());
            $seatNum1="";
            $seatNum2="";
            $seatNum3="";
            $seatNum4="";
            $seatNum5="";
            $i=1;
            while($i<=$pax_count){
                ${'seatNum' . $i} = $max_seat_count + $i;
                $seatNumbers[$i-1] = ${'seatNum' . $i};
                $i++;
            }
            //dd($seatNumbers);
            DB::table('bookings')->insert([
                'seat_check_id' => $seat_check_id,
                'traveller_id' => $travellerId,
                'seats_booked' => $pax_count,
                'created_at' => $timestamp,
                'city1' => $city1,
                'city2' => $city2,
                'seatNum1' => $seatNum1,
                'seatNum2' => $seatNum2,
                'seatNum3' => $seatNum3,
                'seatNum4' => $seatNum4,
                'seatNum5' => $seatNum5
                
            ]);
            $y = $city1_index;
            while($y<$city2_index){
                $city = 'city'.$y;
                $seat_count = $seat_check[0]->$city;
                $seat_count_new = $seat_count+$pax_count;
                
                DB::table('seat_checks')
                    ->where('id',$seat_check_id)
                    ->update(['city'.$y.'' => $seat_count_new]);
                    $y++;
                }
            
        }

        $bookingId = (DB::select('select id from bookings where created_at = "'.$timestamp.'"AND traveller_id='.$travellerId.' AND seat_check_id='.$seat_check_id.''))[0]->id;
        
        
        
        
        return view('/traveller/ticket',['bookingId'=>$bookingId,'train_id'=>$train_id,'city1'=>$city1,'city2'=>$city2,'total_price'=>$total_price,'date'=>$date,'time1'=>$time1,'time2'=>$time2,'pax_count'=>$pax_count,'inputName'=>$inputName,'inputTp'=>$inputTp,'seatNum1'=>$seatNum1,'seatNum2'=>$seatNum2,'seatNum3'=>$seatNum3,'seatNum4'=>$seatNum4,'seatNum5'=>$seatNum5]);
         
     }
     
     public function downloadTicket($bookingId){
        
        //dd($show->id);
        $bookingDetails = DB::select('select * from bookings where id = "'.$bookingId.'"');
        $travellerId = $bookingDetails[0]->traveller_id;
        $seat_check_id = $bookingDetails[0]->seat_check_id;
        $travellerDetails = DB::select('select * from travellers where id = "'.$travellerId.'"');
        $seat_check = DB::select('select * from seat_checks where id = '.$seat_check_id.'');
        

        $train_id = $seat_check[0]->train_id;
        $route_id = $seat_check[0]->route_id;
        $city1 = $bookingDetails[0]->city1;
        $city2 = $bookingDetails[0]->city2;
        $pax_count = $bookingDetails[0]->seats_booked;
        $price = DB::select('select * from prices where route_id = '.$route_id.'');

        $i=1;
        while($i<11){
           if(DB::select('select city'.$i.' from train_routes where city'.$i.' = "'.$city1.'"AND id='.$route_id.'')){
              $city1_index = $i;
           }
           if(DB::select('select city'.$i.' from train_routes where city'.$i.' = "'.$city2.'"AND id='.$route_id.'')){
            $city2_index = $i;
           }
           $i++;
        }
        $i=0;
        $y = $city1_index;
        $total_price = 0;
        while($y<$city2_index){
            $price_count[$i] = data_get($price, '*.city'.$y);
            $total_price += $price_count[$i][0];
            $y++;
            $i++;
            }
        $total_price = $pax_count*$total_price;
        $date = $seat_check[0]->date;
        $time1 = (DB::select('select '.$city1_index.' from time_tables where route_id = '.$route_id.''))[0]->$city1_index;
        $time2 = (DB::select('select '.$city2_index.' from time_tables where route_id = '.$route_id.''))[0]->$city2_index;
        $inputName = $travellerDetails[0]->name;
        $inputTp = $travellerDetails[0]->telephone;
        $seatNum1="";
        $seatNum2="";
        $seatNum3="";
        $seatNum4="";
        $seatNum5="";
        $i=1;
        while($i<=$pax_count){
            ${'seatNum' . $i} =  data_get($bookingDetails, '*.seatNum'.$i)[0];
            $i++;
        }
      

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('/traveller/ticketPdf',['bookingId'=>$bookingId,'train_id'=>$train_id,'city1'=>$city1,'city2'=>$city2,'total_price'=>$total_price,'date'=>$date,'time1'=>utf8_decode(urldecode($time1)),'time2'=>$time2,'pax_count'=>$pax_count,'inputName'=>$inputName,'inputTp'=>$inputTp,'seatNum1'=>$seatNum1,'seatNum2'=>$seatNum2,'seatNum3'=>$seatNum3,'seatNum4'=>$seatNum4,'seatNum5'=>$seatNum5]);
        
        return $pdf->download('downloadTicket.pdf');
         
     }

}