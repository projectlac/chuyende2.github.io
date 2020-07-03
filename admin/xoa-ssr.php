<?php session_start();
$id=$_GET['id'];
 include('../database.php');

 $query = mysqli_query($conn,"DELETE FROM optionsq2 WHERE optionsQ2_id = '$id'");

    if ($query === TRUE) {
         echo "<script>
    var r = confirm('Xóa tin thành công');
      if (r == true) {
        window.location.replace('thongtin-ssr.php');
        } else {window.location.replace('thongtin-ssr.php');}
    </script> ";
    } else {
        echo "Lỗi gì đó đã xảy ra".$conn->error;
    }
mysqli_close($conn);
?>
