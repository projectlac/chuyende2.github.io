<?php
error_reporting(0);
include('../databáe.php');
//Khai báo giá trị mặc định, dung lượng file upload
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
  $uploaddir = "images/"; //khai báo thư mục để lưu ảnh
/*
* Sử dụng vòng lặp, vì form upload có thể chọn upload nhiu file (multiple="true") có name là một mảng photos[]
*/
  foreach($_FILES['photos']['name'] as $name => $value){
    $filename = stripslashes($_FILES['photos']['name'][$name]);//lấy tên của file
    $size=filesize($_FILES['photos']['tmp_name'][$name]);//tính dung lượng của file
    //Sử dụng hàm getExtension lấy phần mở rộng của file
    $ext = getExtension($filename);
    $ext = strtolower($ext);//đổi tất cả text thành chữ thường
    //Kiểm tra phần mở rộng vừa lấy có nằm trong mảng $valid_formats
    if(in_array($ext,$valid_formats)){
      //Kiểm tra dung lượng file bao nhieu thì được upload
      if ($size < (MAX_SIZE*1024)){
        //Đặt lại tên file tránh bị trùng theo hàm time()
        $image_name=time().$filename;
        //echo ra tấm ảnh được thêm vào
        echo "<img src='".$uploaddir.$image_name."' class='imgList'>";
        //đường dẫn tới file
        $newname=$uploaddir.$image_name;
        //Sử dụng hàm move_uploaded_file để chuyển file vào đường dẫn được chỉ định
        if(move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)){
           $time=time();
           //Thêm các thông tin vào cở sở dữ liệu
           mysql_query("INSERT INTO optionsQ2(optionsQ2_value) VALUES('$image_name')");
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