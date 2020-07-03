<?php $thongtin_ssr = laythongtin_ssr(); ?>

<link rel="stylesheet" href="plugin/owl-carouse/owl.carousel.min.css">

<link rel="stylesheet" href="plugin/owl-carouse/owl.theme.default.min.css">

<link rel="stylesheet" href="plugin/animsition/css/animate.css">
<div class="thongtin-ssr">
           
          <!--   <div class="col-md-4"><p>NAME</p></div> -->
 
                    <div class="slide2 owl-carousel owl-theme" >
          <?php foreach ($thongtin_ssr as $item) { ?>
           
          
                        <div class="item1">
                              
                                    <div class="col-md-12">
                                        <div class="col-md-4 hiddenx">
                                        <img src="images/web/tenyl/<?=$item['optionsQ2_value']?>" alt="">
                                    </div>
                                    <div class="col-md-4 col-xs-12 hinh-yl">
                                        <img src="images/web/yl/<?=$item['hinh']?>" alt="">
                                    </div>
                                    <div class="col-md-4 col-xs-12 hiddenx">
                                        <div class="cottruyen ">
                                            <img src="images/web/bang.png" alt="" class="bang">
                                        </div>
                                        <div class="text">
                                            <p>
                                              <?=$item['cottruyen']?>
                                            </p>
                                        </div>

                                    </div>
                                    </div>
                        </div>
                <?php } ?>
                            
                     
                    </div>
                 
         
</div>




<script src="plugin/owl-carouse/owl.carousel.min.js"></script>
  <script>
   
$(document).ready(function (){

        $('.slide2').owlCarousel({

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
