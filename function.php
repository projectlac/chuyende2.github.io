
<?php 
function laythongtin(){
	include("database.php");
$sql= "SELECT * FROM news order by news_id desc limit 7";
$rows=[];
      $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 while($tintuc = mysqli_fetch_array($query)){

        $rows[] = $tintuc;

    }

    return $rows;

}


function laybanner(){
	include("database.php");
$sql= "SELECT * FROM optionsq1 order by optionsQ1_id";
$rows=[];
      $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 while($row = mysqli_fetch_array($query)){

        $rows[] = $row;

    }

    return $rows;
}

function laythongtin_ssr(){
		include("database.php");
$sql= "SELECT * FROM optionsq2 order by optionsQ2_id desc";
$rows=[];
      $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 while($row = mysqli_fetch_array($query)){

        $rows[] = $row;

    }

    return $rows;

}

function laychitietthongtin($x){
  include("database.php");
  $id = $x;

$sql= "SELECT * FROM news where friendly_url = '$id'";
$rows=[];
      // $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
  }
};
 ?>
