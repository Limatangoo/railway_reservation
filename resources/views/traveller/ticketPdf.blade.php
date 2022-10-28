<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<!--['bookingId'=>$bookingId,'train_id'=>$train_id,'city1'=>$city1,'city2'=>$city2,'total_price'=>$total_price,'date'=>$date,'time1'=>$time1,'time2'=>$time2,'pax_count'=>$pax_count,'inputName'=>$inputName,'inputTp'=>$inputTp]-->
    <section class="container p-5 border border-dark">
        <div class="row mt-10">
            <h1>Ticket Reference</h1>
            <div class="col-4">
                <img src="{{asset('../images/train-vector.png')}}" class=" img-thumbnail">
            </div>
            <div class="col-8"><p class="font-weight-bold display-6">Sri Lanka Railways</p></div>
        </div>
        <table>
            <tr>
              <td>Ticket ID</td>
              <td>{{$bookingId}}</td>
            </tr>
            <tr>
              <td>Train ID</td>
              <td>{{$train_id}}</td>
            </tr>
            <tr>
              <td>Total Bill Value</td>
              <td>{{$total_price}}</td>
            </tr>
            <tr>
              <td>Journey Date</td>
              <td>{{$date}}</td>
            </tr>
            <tr>
              <td>Journey Start</td>
              <td>{{$city1}}</td>
              <td><?php echo utf8_decode(urldecode( $time1 ))?></td>
            </tr>
            <tr>
              <td>Journey End</td>
              <td>{{$city2}}</td>
              <td>({{$time2}})</td>
            </tr>
            <tr>
              <td>Seat Numbers</td>
              @for ($i = 0; $i < $pax_count; $i++)
              <?php $seatNum = ${'seatNum'.$i+1} ?>
                    <td>
                      {{$seatNum}}A
                    </td>
                @endfor
              </tr>
            <tr>
              <td>Name</td>
              <td>{{$inputName}}</td>
            </tr>
            <tr>
              <td>Telephone Number</td>
              <td>{{$inputTp}}</td>
            </tr>
            <tr>
              <td>Issued Date</td>
              <td>{{date('Y-m-d h:i:s', time())}}</td>
            </tr>
        
        </table>
        
       

        
    


    </section>





</body>
</html>
