<?php 
$banner = laybanner();
 ?>

<link rel="stylesheet" href="plugin/owl-carouse/owl.carousel.min.css">

<link rel="stylesheet" href="plugin/owl-carouse/owl.theme.default.min.css">

<link rel="stylesheet" href="plugin/animsition/css/animate.css">
<div class="page-js">
<!-- <iframe width="420" height="345" src="http://www.youtube.com/embed/oHg5SJYRHA0?autoplay=1" frameborder="0" allowfullscreen></iframe> -->
            <div class="slidess">
                    <div class="slide1 owl-carousel owl-theme" >
          <?php foreach ($banner as $item) { ?>
          
        
                    <div class="item">
                            <div class="banner-x-logo">
                                
                                <div class="banner-x">
                                    <img src="images/<?=$item['optionsQ1_value']?>" alt="Owl Image">
                                </div>
                                <div class="logo">
                                   <a href="#"> <img src="images/web/logo-bang.png" alt=""></a>
                                </div>
                            </div>
                       
                    
                     
                    </div>
          <?php     } ?> 

                    </div>

            
            </div>
      </div>

<script src="plugin/owl-carouse/owl.carousel.min.js"></script>
  <script>
   
$(document).ready(function (){

        $('.slide1').owlCarousel({

            loop:true,

            margin:0,

            navSpeed:1500,

            nav:false,

            dots: false,

            autoplay: true,

            rewind: true,

            navText:[],

            items:1,

            responsive:{

                0:{

                    nav:false

                },

                767:{

                    nav:false

                }

            }

        });

    });
  </script>