<?php session_start();
$id=$_GET['id'];
include('function.php');

$chitiet = laychitietthongtin($id);
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (isset($_POST['updatenews'])) 
{
    //Kết nối tới database
    include('../database.php');
     
    //Lấy dữ liệu nhập vào
    $title = $_POST['title'];
    $content =$_POST['content'];
    $date = date("Y-m-d h:i:s");
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$title ) {
        echo "Vui lòng nhập tiêu đề. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     
    // mã hóa pasword
  
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $query = mysqli_query($conn,"UPDATE news SET news_name='$title',news_content='$content',news_created_date='$date' WHERE news_id='$id'");
    // if (mysqli_num_rows($query) == 0) {
    //     echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //     exit;
    // }
     
    //Lấy mật khẩu trong database ra
    // $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    // if ($password != $row['admin_password']) {
    //     echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //     exit;
    if ($query === TRUE) {
         echo "<script>
    var r = confirm('Cập nhật tin thành công');
      if (r == true) {
        window.location.replace('tintuc.php');
        } else {window.location.replace('tintuc.php');}
    </script> ";
    } else {
        echo "Lỗi gì đó đã xảy ra".$conn->error;
    }
mysqli_close($conn);
    }
     
if (isset($_POST['deletenews'])) 
{
    //Kết nối tới database
    include('../database.php');
     
    //Lấy dữ liệu nhập vào
    $title = $_POST['title'];
    $content =$_POST['content'];
    $date = date("Y-m-d h:i:sa");
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$title ) {
        echo "Vui lòng nhập tiêu đề. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     
    // mã hóa pasword
  
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $query = mysqli_query($conn,"DELETE FROM news WHERE news_id = '$id'");
    // if (mysqli_num_rows($query) == 0) {
    //     echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //     exit;
    // }
     
    //Lấy mật khẩu trong database ra
    // $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    // if ($password != $row['admin_password']) {
    //     echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //     exit;
    if ($query === TRUE) {
         echo "<script>
    var r = confirm('Xóa tin thành công');
      if (r == true) {
        window.location.replace('tintuc.php');
        } else {window.location.replace('tintuc.php');}
    </script> ";
    } else {
        echo "Lỗi gì đó đã xảy ra".$conn->error;
    }
mysqli_close($conn);
    }
     
    
   



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
         <div class="nen-news">
           <div class="role">
             <?php 
             if (isset($_SESSION['username']) && $_SESSION['username']){  ?>
              <p class="role-text">Xin chào: <?=($_SESSION['username'] = 'admin-dau')? 'Dâu đẹp trai':'Admin'?> <a href="logout.php">Logout</a></p>
           <!--    <a href="them-tintuc.php" style="float: left;">Thêm</a>       -->    
      <?php  }?>
              <p class="tieude-baiviet">Tin tức</p>
              <hr>
           <div class="noidung-moi">
              <form action="sua-tintuc.php?do=sua-tintuc&id=<?=$chitiet['news_id']?>" method="POST">
              <div class="wrap-input100 validate-input" data-validate = "User is required">
                  <input class="input100" type="text" name="title" value="<?=$chitiet['news_name']?>" style="height: 30px;">
                  <span class="focus-input100"></span>
                 <!--  <span class="label-input100">Tiêu đề</span> -->
              </div>
              <textarea name="content">
               <?=$chitiet['news_content']?>
              </textarea>
              <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit" name="updatenews" style="width: 80%">
                Sửa
              </button>
              <button class="login100-form-btn" type="submit" name="deletenews" style="width: 10%;margin-left: 10px;">
                Xóa
              </button>
          </div>
              </form>

           </div>
           </div>
         </div>
       </div>
       <script>
    tinymce.init({
      height:'300',
      selector: 'textarea',
      plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor align | link image media | removeformat help',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
<?php include("footer.php") ?>
