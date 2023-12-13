@extends('layouts.app')

@section('content')
            {{-- Homepage --}}
{{-- <div class="homepage-container">
    <div class="our-services">
        <div class="service-tab">
            <h1>Gym Access</h1>
        </div>
        <div class="service-tab">
            <h1>Workout Advice</h1>
        </div>
        <div class="service-tab">
            <h1>Nutritional Advice</h1>
        </div>
    </div>
    <div class="our-classes">
        <a href="{{ route('classes') }}"> View Classes </a>
    </div>
</div> --}}

<?php
//   include("./includes/header.php");
?>

<div class="image-grid" id="main-content">
    <img src="{{ asset('images/gym1-min.webp') }}" class="flex-item" alt="A man is lifting a weight." loading="lazy">
    <img src="{{ asset('images/gym2-min.webp') }}" class="flex-item" alt="A group of individuals engaged in a workout session." loading="lazy">
    <img src="{{ asset('images/gym3-min-min.webp') }}" class="flex-item" alt="A man performing push-ups." loading="lazy">
    <img src="{{ asset('images/gym4-min.webp') }}" class="flex-item" alt="Two individuals engaged in boxing practice." loading="lazy">
    <img src="{{ asset('images/gym5-min.webp') }}" class="flex-item" alt="A group of people exercising together." loading="lazy">
    <img src="{{ asset('images/gym6-min.webp') }}" class="flex-item" alt="A man performing a chest press exercise." loading="lazy">
    <div class="button-align">
       <form action="{{ route('classes') }}" method="get">
          <button type="submit" class="view-class-btn">View Classes</button>
       </form>
    </div>
 </div>


   
  
  
    <!-- The slideshow -->
   <h1 class="services-h">Services</h1>
    <div id="demo" class="carousel slide" data-ride="carousel">
     
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/pass.png" alt="Los Angeles" width="1100" height="500">
          
        </div>
        <div class="carousel-item">
          <img src="images/chestpump.webp" alt="Chicago" width="1100" height="500">
        </div>
        <div class="carousel-item">
          <img src="images/Cardio.png" alt="New York" width="1100" height="500">
        </div>
      </div>
      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  


<div class="split">
  <div class="split-left">
    <h1 class="join-now">join now from £21.99 a month</h1>
    <button class="join-btn">Join Now</button>

  </div>
</div>



@endsection

