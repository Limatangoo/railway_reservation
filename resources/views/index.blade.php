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

<div class="container text-center mt-5 "><h1 class="justify-content-center">Welcome to railway reservation System</h1></div>
<div class="container mt-9 p-5 border border-dark">
<div class="container">
<form action="validity" method="get" >
            {{csrf_field()}}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mt-4">
                <label for="from_destination">From</label>
                    <select class="custom-select" id="from_destination" name="from_destination" required value="{{ old('field') }}">
                        <option value="Colombo">Colombo</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Aluthgama">Aluthgama</option>
                        <option value="Balapitiya">Balapitiya</option>
                        <option value="Ambalangoda">Ambalangoda</option>
                        <option value="Hikkaduwa">Hikkaduwa</option>
                        <option value="Galle">Galle</option>
                        <option value="Ahangama">Ahangama</option>
                        <option value="Weligama">Weligama</option>
                        <option value="Matara">Matara</option>
                        

                        <option value="Polgahawela">Polgahawela</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Maho">Maho</option>
                        <option value="Galgamuwa">Galgamuwa</option>
                        <option value="Tambuttegama">Tambuttegama</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                    </select>
                                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mt-4">
                <label for="to_destination">To</label>
                <select class="custom-select" id="to_destination" name="to_destination" required value="{{ old('field') }}">
                    <option value="Colombo">Colombo</option>
                    <option value="Kalutara">Kalutara</option>
                    <option value="Aluthgama">Aluthgama</option>
                    <option value="Balapitiya">Balapitiya</option>
                    <option value="Ambalangoda">Ambalangoda</option>
                    <option value="Hikkaduwa">Hikkaduwa</option>
                    <option value="Galle">Galle</option>
                    <option value="Ahangama">Ahangama</option>
                    <option value="Weligama">Weligama</option>
                    <option value="Matara">Matara</option>
                    
                    <option value="Polgahawela">Polgahawela</option>
                    <option value="Kurunegala">Kurunegala</option>
                    <option value="Maho">Maho</option>
                    <option value="Galgamuwa">Galgamuwa</option>
                    <option value="Tambuttegama">Tambuttegama</option>
                    <option value="Anuradhapura">Anuradhapura</option>
                    
                    </select>
                                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3 ">
                <label for="start_date">Date</label>
                <input type="date" class="form-control" id="start_date"  name="start_date" value="{{ old('field') }}">
                
            </div>
            @error('start_date')
                    <div class="text-danger error">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex form-group mb-3">
            <label for="pax_count">Number of Passengers</label>
            <input type="Number" name="pax_count" id="pax_count" required value="{{ old('field') }}" class=" mx-3">
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="col-sm-2 btn btn-primary">Submit</button>
        </div>
    <div>
</form>
</div>
</div>



<div class="row">
        @if(isset($alltrains))
       <p class="text-danger text-center mt-4">{{$alltrains}}</p>
       @endif
</div>

<div class="row mt-9">
    <table class="table"> 
    @if(isset($total_options) && $total_options > 0)
    <thead>
    <tr>
        <th scope="col">Train Route</th>
        <th scope="col">Departs</th>
        <th scope="col">Arrives</th>
        <th scope="col">Available seats</th>
        <th scope="col">Price</th>
        <th scope="col"></th>
    </tr>
   </thead>
   @for ($i = 0; $i < $total_options; $i++)
    <tbody>
        <tr>
            <td>{{$seat_check[$i][0]->route_id}}</td>
            <td>{{$seat_check[$i][0]->date}}<br>{{$start_time[$i][0]}}<br>{{$city1}}</td>
            <td>{{$journey_end_date[$i]}}<br>{{$end_time[$i][0]}}<br>{{$city2}}</td>
            <td>{{$avail_seats[$i]}}</td>
            <td>{{$total_price[$i]}}</td>
            <td><button type="button" class="btn btn-warning">Book Now</button></td>
        </tr>
    @endfor
  
    
    @endif
    </tbody>
    </table>
</div>


<script type="text/javascript" src="{{ URL::asset('/js/index.js') }}"></script>

</body>