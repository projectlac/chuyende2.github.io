<?php session_start();
include('function.php');
include('../database.php');
define("MAX_SIZE","9000");
//Hàm kiểm tra phần mở rộng của file upload, giá trị trả về là đuôi của file
function getExtension($str){
  $i = strrpos($str,".");
  if (!$i) { return ""; }
  $l = strlen($str) - $i;
  $ext = substr($str,$i+1,$l);
  return $ext;
}
//Mảng có các phần tử là các dạng của tấm ảnh
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
  $SSR_name = $_POST['name'];
  $cottruyen =$_POST['content'];
  $uploaddir = "../images/web/yl/";
  $uploaddir1 = "../images/web/tenyl/"; //khai báo thư mục để lưu ảnh
/*
* Sử dụng vòng lặp, vì form upload có thể chọn upload nhiu file (multiple="true") có name là một mảng photos[]
*/
  foreach($_FILES['photos']['name'] as $name => $value){
    $filename = stripslashes($_FILES['photos']['name'][$name]);//lấy tên của file
    $size=filesize($_FILES['photos']['tmp_name'][$name]);//tính dung lượng của file

    $filename1 = stripslashes($_FILES['photos1']['name'][$name]);//lấy tên của file
    $size1=filesize($_FILES['photos1']['tmp_name'][$name]);//tính dung lượng của file


    //Sử dụng hàm getExtension lấy phần mở rộng của file
    $ext = getExtension($filename);
    $ext = strtolower($ext);
    $ext1 = getExtension($filename1);
    $ext1 = strtolower($ext1);//đổi tất cả text thành chữ thường
    //Kiểm tra phần mở rộng vừa lấy có nằm trong mảng $valid_formats
    if(in_array($ext,$valid_formats)||in_array($ext1,$valid_formats)){
      //Kiểm tra dung lượng file bao nhieu thì được upload
      if ($size < (MAX_SIZE*1024)){
        //Đặt lại tên file tránh bị trùng theo hàm time()
        $image_name=time().$filename;
        $image_name1=time().$filename1;
        //echo ra tấm ảnh được thêm vào
       
        //đường dẫn tới file
        $newname=$uploaddir.$image_name;
        $newname1=$uploaddir1.$image_name1;
        move_uploaded_file($_FILES['photos1']['tmp_name'][$name], $newname1);
        //Sử dụng hàm move_uploaded_file để chuyển file vào đường dẫn được chỉ định
        if(move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)){
           $time=time();
           //Thêm các thông tin vào cở sở dữ liệu
           mysqli_query($conn,"INSERT INTO optionsQ2(hinh,SSR_name,cottruyen,optionsQ2_value) VALUES('$image_name','$SSR_name','$cottruyen','$image_name1')");
           echo "<script>
    var r = confirm('Thêm SSR thành công');
      if (r == true) {
        window.location.replace('thongtin-ssr.php');
        } else {window.location.replace('thongtin-ssr.php');}
    </script> ";
        }else{
           echo '<span class="imgList">Có lỗi trong quá trình upload </span>';
        }
    }else{
       echo '<span class="imgList">Dung lượng file quá lớn!</span>';
    }
   }else{
     echo '<span class="imgList">Vui lòng chọn file ảnh</span>';
    }
  }
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
       <script>
 $(document).ready(function() {
    $('#photoimg').die('click').live('change', function(){
    //Sử dụng ajaxForm trong JQuery
    $("#imageform").ajaxForm({
      target: '#preview',
      beforeSubmit:function(){ //việc cần làm trước khi submit
        $("#imageloadstatus").show();
        $("#imageloadbutton").hide();
      },
      success:function(){//việc cần làm khi submit thành công
        $("#imageloadstatus").hide();
        $("#imageloadbutton").show();
      },
      error:function(){//việc cần làm khi xảy ra lỗi
        $("#imageloadstatus").hide();
        $("#imageloadbutton").show();
      } }).submit();
    });
  });
 </script>
       <div class="giaodien-admin">
         <div class="nen-news">
           <div class="role">
             <?php 
             if (isset($_SESSION['username']) && $_SESSION['username']){  ?>
              <p class="role-text">Xin chào: <?=($_SESSION['username'] = 'admin-dau')? 'Dâu đẹp trai':'Admin'?> <a href="logout.php">Logout</a></p>
              <a href="index-admin.php" style="float: left;">Trang ADMIN</a>          
      <?php  }?>
              <p class="tieude-baiviet">Thêm SSR</p>
              <hr>
           <div class="noidung-moi">
              <form action="them-ssr.php?do=them-ssr" method="POST" enctype="multipart/form-data" >
              <div class="wrap-input100 validate-input" data-validate = "User is required">
                  <input class="input100" type="text" name="name" style="height: 30px;">
                  <span class="focus-input100"></span>
                  <span class="label-input100">Tên</span>
              </div>
              <div class="col-md-6">
                <textarea name="content">
               
              </textarea>
              </div>
              <div class="col-md-6">
               <div class="wrap-input100 validate-input" data-validate = "User is required">
                <!--  <div id='imageloadstatus' style='display:none'><img src="images/loader.gif" alt="Uploading...."/></div> -->
                 <div id='imageloadbutton'>

                     <input type="file" name="photos[]" id="photoimg" multiple="true" />
                     <input type="file" name="photos1[]" id="photoimg1" multiple="true" />
                  </div>
                  <span class="focus-input100"></span>
                 <!--  <span class="label-input100">Tiêu đề</span> -->
              </div>
              </div>
              <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit">
                Thêm SSR
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
