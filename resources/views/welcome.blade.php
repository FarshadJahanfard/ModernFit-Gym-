@extends('layouts.app')

@section('content')

<div class="image-grid" id="main-content">
   <img src="{{ asset('images/gym1.svg') }}" class="flex-item" alt="A man is lifting a weight.">
   <img src="{{ asset('images/gym2.svg') }}" class="flex-item" alt="A group of individuals engaged in a workout session.">
   <img src="{{ asset('images/gym3.svg') }}" class="flex-item" alt="A man performing push-ups.">
   <img src="{{ asset('images/gym4.svg') }}" class="flex-item" alt="Two individuals engaged in boxing practice.">
   <img src="{{ asset('images/gym5.svg') }}" class="flex-item" alt="A group of people exercising together.">
   <img src="{{ asset('images/gym6.svg') }}" class="flex-item" alt="A man performing a chest press exercise.">
   <div class="button-align">
    <form action="{{ route('classes') }}" method="get">
        <button type="submit" class="view-class-btn">View Classes</button>
    </form>
   {{-- <a href="{{ route('classes') }}"> View Classes </a> --}}

   </div>
</div>

<div class="split">
  <div class="split-left">
    <h1 class="join-now">join now from £21.99 a month</h1>
    <button class="join-btn">Join Now</button>

  </div>
</div>


Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae repudiandae rerum mollitia quasi deleniti, odit consequuntur perspiciatis, id harum aliquam nobis quidem minus minima doloremque voluptatem voluptatum earum pariatur provident itaque magni porro cumque beatae nihil! Excepturi est vel, id modi minus laborum in ut. Sed dolore dolorem officiis rem, cupiditate quis minima deserunt! Exercitationem, quas itaque nemo ratione inventore eos in delectus facilis animi amet vitae quia rem nostrum ab assumenda consequuntur pariatur qui suscipit omnis explicabo. Ipsum amet, facilis odio iste dolor ut porro ad sunt nobis architecto ex? Velit asperiores et, aperiam, aliquid, quam quidem ex adipisci iure provident perferendis aliquam omnis deleniti facere? Velit possimus delectus incidunt architecto tempore voluptatibus, quae esse. Consectetur exercitationem libero dolor est ullam sint eaque eligendi id? Quis excepturi, mollitia dolorem et quo in architecto tempora minima deleniti non necessitatibus quibusdam fugiat earum aut maiores iusto praesentium? Veritatis sit quibusdam, tempora iure consequuntur modi, dolorem nemo debitis quas iste accusamus perferendis fuga aut. Doloribus placeat soluta quia voluptates corrupti possimus aut non esse aperiam temporibus unde, reprehenderit dolorem fugit, eos in ipsum voluptatum. Tenetur illo unde a? Illum earum et id magni dicta alias similique. Deleniti dicta enim cupiditate pariatur nisi.


@endsection

