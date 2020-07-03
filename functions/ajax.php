
<?php
	session_start();
	ob_start();
	include_once("../__autoload.php");
	include_once('../functions/database.php');
	include_once('../functions/library.php');
	include_once('../functions/pagination/Pagination.php');
	include_once('action.php');
	include_once('action_cart.php');
	include_once('action_registration.php');

	$cart = new action_cart;
	$action = new action();
	$action_registration = new action_registration();

	if (isset($_GET["action"]) && $_GET["action"] != "") {
		$action = ($_GET["action"]);
		switch ($action) {

			case 'abc':
				$cart->test_cart();
				break;

			case 'submitPayment':
				$cart->submitPayment();
				break;

			case "addCompare":
				$cart->addCompare();
				break;
			case "addCart":
				$cart->addToCart();
				break;
			case "removeItem":
				$cart->removeItemCart();
				break;
			case "remove":
				$cart->removeFromCart();
				break;
			case "empty":
				$cart->emptyCart();
				break;
			case 'formAddCart':
				$cart->formAddCart();
				break;
				
			case 'updateCart':
				$cart->updateCart();
				break;
			
			case "emptyCompare":
				$cart->emptyCompare();
				break;

			case "removeCompare":
				$cart->removeCompare();
				break;

			case "addWishlist":
				$cart->addWishlist();
				break;

			case "removeWishlist":
				$cart->removeWishlist();
				break;

			case "payment":
				$cart->payment();
				break;

			case "test":
				$cart->test();
				break;
				
			case "add_cart":
				$cart->add_cart();
				break;
	
		}
	}
	
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case 'regForm':
				$action->regForm();
				break;
			
			case 'checkUsername':
				$action->checkUsername();
				break;

			case 'loginForm':
				$action->loginForm();
				break;

			case 'formQandA':
				$action_registration->formQandA();
				break;

			case 'formInfo':
				$action_registration->formInfo();
				break;

			case 'formRegMember':
				$action_registration->formRegMember();
				break;
				
			default:
				# code...
				break;
		}
	}



	
?>