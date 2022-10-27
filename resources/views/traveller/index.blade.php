<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
      
      
    </ul>
   
  </div>
</nav>
</div>

<div class="container text-center mt-5 "><h1 class="justify-content-center">Booking Details</h1></div>
<div class="container mt-9 p-5 border border-dark">
<div class="container">
<form action="/traveller/ticket" method="get" >
            {{csrf_field()}}
            <form>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" name="inputName" id="inputName"  placeholder="Enter your name" required>
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group mt-3">
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" name="inputEmail" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        @error('inputEmail')
                    <div class="text-danger error"><p>Email Error</p></div>
        @enderror
        <div class="form-group mt-3">
            <label for="inputTp">Telephone Number</label>
            <input type="number" class="form-control" name="inputTp" id="inputTp"  placeholder="enter your 10 digit telephone number here" required>
        </div>
        @error('inputTp')
                    <div class="text-danger error"><p>Telephone number must not have more than 10 digits</p></div>
        @enderror
        <div class="row mt-5">
            <div class="col-6">
                <div class="d-flex flex-row">
                   <div>
                     <p class="mx-2 text-success">From:</p>
                   </div>
                   <div>
                     <p><input type="text" name="inputCity1" readonly value="{{$city1}}"></p>
                     <p><input type="text" name="inputDate1" readonly value="{{$date}}"></p>                   
                     <p><input type="text" name="inputTime1" readonly value="{{$time1}}"></p>
                   </div>
                </div>

            </div>
            <div class="col-6">
            <div class="d-flex flex-row">
                   <div>
                     <p class="mx-2 text-danger">To:</p>
                   </div>
                   <div>
                   <p><input type="text" name="inputCity2" readonly value="{{$city2}}"></p>
                     <p><input type="text" name="inputDate2" readonly value="{{$date}}"></p>                   
                     <p><input type="text" name="inputTime2" readonly value="{{$time2}}"></p>
                   </div>
                </div>
                

            </div>

        </div>

        <div class="row mt-5 ">
            <div class="col-6">
                <div class="d-flex flex-row ">
                   <div>
                     <p class="mx-2">Seats Booked :</p>
                   </div>
                   <div>
                   @if(isset($pax_count))
                    <p class="text-center"><input type="text" name="inputPaxCount" readonly value="{{$pax_count}}"></p>
                   @endif 
                   </div>
                </div>

            </div>
            <div class="col-6">
            <div class="d-flex flex-row ">
                   <div>
                     <p class="mx-2">Total Amount :</p>
                   </div>
                   <div>
                     <p><input type="text" name="inputTotalAmount" readonly value="{{(int)$total_price*(int)$pax_count}}"></p> 
                   </div>
            </div>
                
            
            </div>

        </div>
        <input type="number" name="inputSeatCheckId" hidden value="{{$seat_check_id}}">
       
        <div class="row mt-5 text-center">
            <button type="submit" class="btn btn-primary mt-3 w-10">Pay Now</button>
        </div>

    
</form>
</div>
</div>









</body>
</html>