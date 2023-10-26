<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home | Modern Fit Gym</title>
  <link rel="stylesheet" href="css/desktop.css" />
  <script src="../js/img-slider.js"></script>
</head>

<body>
  <?php
  include("./includes/header.php");
  ?>


<div class="main-content">


<!-- <div class="slider-container">
    <div class="slider">
        <img src="./Images/gym1.jpg" alt="Image 1">
        <img src="i./Images/gym1.jpg" alt="Image 2">
        <img src="./Images/gym1.jpg" alt="Image 3">
        <img src="./Images/gym1.jpg" alt="Image 4">
        <img src="./Images/gym1.jpg" alt="Image 5">
        <img src="./Images/gym1.jpg" alt="Image 6">
    </div>
    <button class="prev" onclick="prevSlide()">Previous</button>
    <button class="next" onclick="nextSlide()">Next</button>
</div> -->



<div class="slideshow-container">



<div class="slideshow-container">

<div class="mySlides fade">

  <img src="./Images/gym2.jpg" style="width:100%">

</div>
<div class="mySlides fade">
  <img src="./Images/gym3.jpg" style="width:100%">
  
</div>

<div class="mySlides fade">
  <img src="./Images/gym2.jpg" style="width:100%">
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>





</div>










</body>
</html>