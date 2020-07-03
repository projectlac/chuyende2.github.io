
<?php
if ($_SESSION['captruycap']<=0){
// {	 echo"<script language='javascript'>alert('Bạn không có quyền')</script>";
	header("Location:../index.php");

}
if ($_SESSION['captruycap']>=1){}