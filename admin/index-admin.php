<?php session_start();
include('function.php');
$list_news = laythongtin();
date_default_timezone_set('Asia/Ho_Chi_Minh');
 ?>


       <?php 

       include("header.php");
       include("baomat.php");
       // if (isset($_SESSION['username']) && $_SESSION['username']){
       //     echo 'Bạn đã đăng nhập với tên là '.$_SESSION['username']."<br/>";
       //     echo 'Click vào đây để <a href="logout.php">Logout</a>';
       // }
       // else{
       //     echo 'Bạn chưa đăng nhập';
       // }
       ?>
       <div class="giaodien-admin">
         <div class="nen-admin">
           <div class="role">
             <?php 
             if (isset($_SESSION['username']) && $_SESSION['username']){  ?>
              <p class="role-text">Xin chào: <?=($_SESSION['username'] = 'admin-dau')? 'Dâu đẹp trai':'Admin'?> <a href="logout.php">Logout</a></p>
              <!-- <a href="them-tintuc.php" style="float: left;">Thêm</a>     -->      
      <?php  }?>
              <a href="tintuc.php"><p class="tieude-baiviet">Tin tức</p></a>
              <hr>
              <a href="thongtin-ssr.php"><p class="tieude-baiviet">Thông tin SSR</p></a>
              <hr>

           </div>
         </div>
       </div>
<?php include("footer.php") ?>