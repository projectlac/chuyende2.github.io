<?php session_start();
include('function.php');
$list_news1 = laySSR();
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
              <a href="index-admin.php" style="float: left; margin-right: 15px;">Trang ADMIN </a><a href="them-ssr.php" style="float: left;"> Thêm</a>          
      <?php  }?>
              <p class="tieude-baiviet">SSR</p>
              <hr>
           <div class="danhsach-tin">
                <table style="width:100%;height: 200px;">
  <tr>
    <th style="width: 50px;">SST</th>
    <th>Tiêu đề</th>
    <th>Delete</th>
  </tr>

  <?php 
$dem=0;
  foreach ($list_news1 as $item) {
    //var_dump($item);
   $dem++;
  ?>
  <tr>
    <td><?=$dem?></td>
    <td><?=$item['SSR_name']?></td>
    <td><a href="xoa-ssr.php?id=<?=$item['optionsQ2_id']?>" >Xóa</a></td>
  </tr>
  <?php } ?>
 
</table>
           </div>
           </div>
         </div>
       </div>
<?php include("footer.php") ?>