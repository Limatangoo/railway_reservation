<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
        <div class="row">
            <div class="col-4">
                <p>Ticket ID</p>
            </div>
            <div class="col-8">{{$bookingId}}</div>
        </div>
        <div class="row">
            <div class="col-4">
               <p>Train ID</p>
            </div>
            <div class="col-8">{{$train_id}}</div>
        </div>
        <div class="row">
            <div class="col-4">
               <p>Total Bill Value</p>
            </div>
            <div class="col-8">{{$total_price}}</div>
        </div>
        <div class="row">
            <div class="col-4">
               <p>Journey Date</p>
            </div>
            <div class="col-8">{{$date}}</div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Journey Start</p>
            </div>
            <div class="col-8"><p class="d-inline">{{$city1}}</p> <span>({{$time1}})</span></div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Journey End</p>
            </div>
            <div class="col-8"><p class="d-inline">{{$city2}}</p> <span>({{$time2}})</span></div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Seat Numbers</p>
            </div>
            <div class="col-8">
                <div class="d-flex flex-row justify-content-around">
                
                @for ($i = 0; $i < $pax_count; $i++)
                <?php $seatNum = ${'seatNum' . $i+1} ?>
                    <div>
                        <p>{{$seatNum}}A</p>
                    </div>
                @endfor
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
               <p>Name</p>
            </div>
            <div class="col-8">{{$inputName}}</div>
        </div>
        <div class="row">
            <div class="col-4">
               <p>Telephone Number</p>
            </div>
            <div class="col-8">{{$inputTp}}</div>
        </div>
        <div class="row">
            <div class="col-4">
               <p>Issued Date</p>
            </div>
            <div class="col-8">{{date('Y-m-d h:i:s', time())}}</div>
        </div>
        
        <div class="row mt-5 text-center">
            <a href="/traveller/downloadTicket/{{$bookingId}}"><button class="btn btn-primary mt-3 w-10">Download</button></a>
        </div>
    


    </section>





</body>
</html>
