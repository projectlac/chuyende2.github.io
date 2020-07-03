<?php 
class user {

	public function register () {
		global $conn_vn;
		$message = "";
		$total_email = 0;
		  if (isset($_POST['save']) ) {
			    $ok = 'true';
			    
			    if ($_POST['password1'] != $_POST['password2']) {
			      $message .= "Mật khẩu không khớp. ";
			      $ok = 'false';
			    }
			    $e = $_POST['email'];
			    $sql_email = "SELECT * FROM user WHERE user_email = '$e'";
			    $result_email = mysqli_query($conn_vn, $sql_email) or die (mysqli_error($conn_vn)); 
			    $total_email = mysqli_num_rows($result_email);
			    if ($total_email >= 1) {
			      $message .= "Email đã tồn tại.";
			      $ok = 'false';
			    }
			    $name = $_POST['name'];
			    $pass = md5($_POST['password1']);
			    $date = date('Y-m-d H:i:s');
			    if (empty($_POST['phone'])) {
			      $phone = "";
			    } else {
			      $phone = $_POST['phone'];
			    }

			    if (empty($_POST['address'])) {
			      $address = "";
			    } else {
			      $address = $_POST['address'];
			    }

			    if ($ok == 'true') {
			      $sql_ins = "INSERT INTO user (user_name, user_email, user_phone, user_address, user_password, state, created_date) VALUES ('$name', '$e', '$phone', '$address', '$pass', 1, '$date')";
			      $result_ins = mysqli_query($conn_vn, $sql_ins) or die (mysqli_error($conn_vn));
			      $_SESSION['user_email_stc'] = $e;
			      
			      echo '<script type="text/javascript">alert(\'Đăng ký thành công.\');</script>';
			      
			      header('Location: /');
		    	} else {
		    		return $message;
		    	}
		  }
	}

	public function login () {
		  global $conn_vn;
		  $num = 0;
		  $message = "";
		  if (isset($_POST['login'])) {
			    $email = $_POST['email'];
			    $password = md5($_POST['password']);
			    $sql_login = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password'";
			    $result_login = mysqli_query($conn_vn, $sql_login) or die(mysqli_error($conn_vn));
			    $num = mysqli_num_rows($result_login);
			    if ($num == 1) {
			      $row = mysqli_fetch_array($result_login, MYSQLI_ASSOC);
			      $_SESSION['user_email_stc'] = $row['user_email'];
			      header('location: /');
			    } else {
			      $message = "Email hoặc password không đúng.";
			    }   
		  }
		  return $message;
	}

	public function logout () {
		unset($_SESSION['user_email_stc']);
		header('location: /');
	}
}
?>