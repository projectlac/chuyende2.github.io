<?php
include_once dirname(__FILE__).DIR_FUNCTIONS."library.php";
include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."Pagination.php";
$class_cart = 'class-cart';
class action_cart extends library{
  public function add_cart(){
      if(isset($_POST["product_id"]))  
       {  
            $order_table = '';  
            $message = '';  
            /*----- ADD TO CART ------*/
            if($_POST["action"] == "add"){  
              if(isset($_SESSION["shopping_cart"]))  
              {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                  if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                  {  
                    $is_available++;  
                    $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
                  }  
                }  
                if($is_available < 1)  
                {  
                  $item_array = array(  
                    'product_id'               =>     $_POST["product_id"],  
                    'product_name'             =>     $_POST["product_name"],  
                    'product_price'            =>     $_POST["product_price"],  
                    'product_quantity'         =>     $_POST["product_quantity"]  
                  );  
                  $_SESSION["shopping_cart"][] = $item_array;  
                }  
              }  
              else  
              {  
                $item_array = array(  
                  'product_id'               =>     $_POST["product_id"],  
                  'product_name'             =>     $_POST["product_name"],  
                  'product_price'            =>     $_POST["product_price"],  
                  'product_quantity'         =>     $_POST["product_quantity"]  
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
              }  
            } 

            /*----- REMOVE FROM CART ----*/
            if($_POST["action"] == "remove"){  
              foreach($_SESSION["shopping_cart"] as $keys => $values)  
              {  
                if($values["product_id"] == $_POST["product_id"])  
                {  
                  unset($_SESSION["shopping_cart"][$keys]);  
                  $message = '<label class="text-success">Product Removed</label>';  
                }  
              }  
            }  

            /*----- CHANGE QUANTITY ----*/
            if($_POST["action"] == "quantity_change") {  
              foreach($_SESSION["shopping_cart"] as $keys => $values)  
              {  
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                {  
                  $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
                }  
              }  
            }

            $order_table .= '  
                '.$message.'  
                <table class="table table-bordered">  
                  <tr>  
                    <th width="40%">Product Name</th>  
                    <th width="10%">Quantity</th>  
                    <th width="20%">Price</th>  
                    <th width="15%">Total</th>  
                    <th width="5%">Action</th>  
                  </tr>  
                ';  

            if(!empty($_SESSION["shopping_cart"]))  
            {  
                $total = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                  $order_table .= '  
                    <tr>  
                      <td>'.$values["product_name"].'</td>  
                      <td><input type="text" name="quantity[]" id="quantity'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="form-control quantity" data-product_id="'.$values["product_id"].'" /></td>  
                      <td align="right">'.$values["product_price"].' VNĐ</td>  
                      <td align="right">'.number_format($values["product_quantity"] * $values["product_price"], 2).' VNĐ</td>  
                      <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'">Remove</button></td>  
                    </tr>  
                  ';  
                  $total = $total + ($values["product_quantity"] * $values["product_price"]);  
                }

                $order_table .= '  
                  <tr>  
                    <td colspan="3" align="right">Total</td>  
                    <td align="right">'.number_format($total, 2).' VNĐ</td>  
                    <td></td>  
                  </tr>  
                  <tr>  
                    <td colspan="5" align="center">  
                      <form method="post" action="cart.php">  
                        <input type="submit" name="place_order" class="btn btn-warning" value="Place Order" />  
                      </form>  
                    </td>  
                  </tr>  
                ';  
            }  
            $order_table .= '</table>';  
            $output = array(  
              'order_table'     =>     $order_table,  
              'cart_item'       =>     count($_SESSION["shopping_cart"])  
            );  
            echo json_encode($output);  
       }  
  }
  /*-------------------------------------------------*/
  public function getProductData($id, $id_color, $id_size){
        global $conn_vn;

        // @option_bello
        // $sql = "SELECT p.product_name, p.product_code, p.product_img, p.product_price, p.friendly_url, c.color_name, c.color_price, s.size_name from product p inner join color c on p.product_id = c.product_id inner join size s on c.color_id = s.color_id where p.product_id = $id and c.color_id = $id_color and s.size_id = $id_size limit 1";

        // @option_basic
        // $sql = "SELECT p.product_name, p.product_code, p.product_img, p.product_price, p.friendly_url, c.color_name, c.color_price, s.size_name from product p inner join color c on p.product_id = c.product_id inner join size s on c.color_id = s.color_id where p.product_id = $id and c.color_id = $id_color and s.size_id = $id_size limit 1";

        $sql = "SELECT * from product where product_id = $id limit 1";
        $result = mysqli_query($conn_vn,$sql);    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }      
        $line = new stdClass;
        $line->name_product = $row['product_name']; 
        $line->price = $row['product_price'];
        $line->link = $row['friendly_url'];
        $line->id_product = $id;
        $line->image_product = $row['product_img'];
        $line->sales = $row['product_price'];
        $line->code_product = $row['product_code'];
        $line->color = $row['color_name'];
        $line->size = $row['size_name'];
        $line->id_color = $id_color;
        $line->id_size = $id_size;  
        return $line;   
    }

  /*-------------------------------------------------*/
  public function addCart($total_price, $session_id, $name_buyer, $email_buyer, $phone_buyer, $address_buyer, $note_buyer){

    global $conn_vn;
    $date_cart = $this->sw_get_current_weekday();
    $sql = "INSERT into cart (session_id, total_price, date_cart, name_buyer, mail_buyer, phone_buyer, address_buyer, note_buyer) values ('".$session_id."',"."'".$total_price."',"."'".$date_cart."',"."'".$name_buyer."',"."'".$email_buyer."',"."'".$phone_buyer."',"."'".$address_buyer."',"."'".$note_buyer."')";
    $result = mysqli_query($conn_vn,$sql);  
    return $conn_vn->insert_id;
  }
  /*-------------------------------------------------*/
  public function addItemCart($id_product, $quantity, $price, $session_id, $color, $size, $id_color, $id_size, $id_cart){
    global $conn_vn;
    if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] != "") {
        $totalPrice = $quantity * $price;
        $sql = "INSERT into cartdetail (id_product, session_id, price_product, qyt_product, totalprice_product, color, size, id_color, id_size, id_cart) values ('".$id_product."',"."'".$session_id."',"."'".$price."',"."'".$quantity."',"."'".$totalPrice."',"."'".$color."',"."'".$size."',"."'".$id_color."',"."'".$id_size."',"."'".$id_cart."')";
        $result = mysqli_query($conn_vn,$sql);    
        return $conn_vn->insert_id;
    }
  }
  /*-------------------------------------------------*/
  public function getCart(){
    $cartArray = array();
    $tmp = 0;
    if(isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] != ""){
        foreach($_SESSION['shopping_cart'] as $key => $value){
            $lines = $this->getProductData($value['product_id'], $value['color'], $value['size']);
            $line = new stdClass;
            $line->name_product = $lines->name_product;//.'>'.$lines->color.'>'.$lines->size;
            $line->id_product = $value["product_id"];
            $line->count = $value["product_quantity"];
            $line->link = $lines->link;
            $line->image_product = $lines->image_product;
            $line->sales = $lines->sales;
            $line->code_product = $lines->code_product;
            $line->color = $lines->color;
            $line->size = $lines->size;
            $line->id_color = $lines->id_color;
            $line->id_size = $lines->id_size;
            $line->price = $value["product_price"];
            $line->total = ($value["product_price"]*$value["product_quantity"]);
            $tmp = $tmp + $line->total;
            $cartArray[] = $line;            
        }
    }
    return $cartArray;  
  }
  /*-------------------------------------------------*/
  public function updateCartTable($total_price,$id_cart){
    global $conn_vn;
    $date_cart = $this->sw_get_current_weekday();
    $sql = "UPDATE cart SET total_price = '".$total_price ."' WHERE id_cart = $id_cart";
    $result = mysqli_query($conn_vn,$sql);  
    return 1;
  }
  /*-------------------------------------------------*/
  public function emptyCart(){
    $_SESSION['shopping_cart'] = "";
    unset($_SESSION['shopping_cart']);
  }
  /*-------------------------------------------------*/
  public function payment(){

      if (!isset($_SESSION['shopping_cart']) || $_SESSION['shopping_cart'] == '') {
          echo json_encode(array('error'=>'Giỏ hàng trống'));
          exit();
      }
      $s = count($_SESSION['shopping_cart']);      
      if(isset($_POST['txtName'])) $name_buyer = $_POST['txtName'];
      if(isset($_POST['txtEmail'])) $email_buyer = $_POST['txtEmail'];
      if(isset($_POST['txtPhone'])) $phone_buyer = $_POST['txtPhone'];
      if(isset($_POST['txtAddress'])) $address_buyer = $_POST['txtAddress'];
      if(isset($_POST['txtNote'])) $note_buyer = $_POST['txtNote'];
      $totalPrice = 0;
      
      $rows = $this->getCart();
      if ($rows == '') {
          echo json_encode(array('error'=>'Giỏ hàng trống'));
          exit();
      }

      $session_id = session_id();    
      $id_cart = $this->addCart(0, $session_id, $name_buyer, $email_buyer, $phone_buyer, $address_buyer, $note_buyer);
      foreach ($rows as $row) {
          $this->addItemCart($row->id_product, $row->count, $row->price, $session_id, $row->color, $row->size, $row->id_color, $row->id_size, $id_cart);
          $totalPrice += $row->total;              
      }
      if($this->updateCartTable($totalPrice,$id_cart)){
          $this->emptyCart();
          session_regenerate_id();
          echo json_encode(array("success"=>"Gửi đơn hàng thành công", "totalCart"=>$this->countCart(), "url"=>"/"));
      }else{
          echo json_encode(array("error"=>"Lỗi, mời thử lại", "totalCart"=>countCart()));
      }      
  }
  /*-------------------------------------------------*/  
  public function payment1 () {
      if (!isset($_SESSION['shopping_cart']) || $_SESSION['shopping_cart'] == '') {
          echo json_encode(array('error'=>'Giỏ hàng trống'));
          echo '<script>alert(\'Giỏ hàng trống\');</script>';
          return "";
      }
      $s = count($_SESSION['shopping_cart']);      
      if(isset($_POST['txtName'])) $name_buyer = $_POST['txtName'];
      // echo $_POST['txtName'];die;
      if(isset($_POST['txtEmail'])) $email_buyer = $_POST['txtEmail'];
      if(isset($_POST['txtPhone'])) $phone_buyer = $_POST['txtPhone'];
      if(isset($_POST['txtAddress'])) $address_buyer = $_POST['txtAddress'];
      if(isset($_POST['txtNote'])) $note_buyer = $_POST['txtNote'];
      $totalPrice = 0;
      
      $rows = $this->getCart();
      if ($rows == '') {
          echo json_encode(array('error'=>'Giỏ hàng trống'));
          echo '<script>alert(\'Giỏ hàng trống\');</script>';
          return "";
      }

      $session_id = session_id();    
      $id_cart = $this->addCart(0, $session_id, $name_buyer, $email_buyer, $phone_buyer, $address_buyer, $note_buyer);
      foreach ($rows as $row) {
          $this->addItemCart($row->id_product, $row->count, $row->price, $session_id, $row->color, $row->size, $row->id_color, $row->id_size, $id_cart);
          $totalPrice += $row->total;              
      }
      if($this->updateCartTable($totalPrice,$id_cart)){
          $this->emptyCart();
          session_regenerate_id();
          echo json_encode(array("success"=>"Gửi đơn hàng thành công", "totalCart"=>$this->countCart(), "url"=>"/"));
          echo '<script>alert(\'Gửi đơn hàng thành công\');</script>';
      }else{
          echo json_encode(array("error"=>"Lỗi, mời thử lại", "totalCart"=>countCart()));
      }      
  }
  /*-------------------------------------------------*/  
  public function countCart(){
      if (isset($_SESSION['shopping_cart'])) {
          $cart = json_decode($_SESSION['shopping_cart']);
          return count($cart);    
      }
  }
  /*-------------------------------------------------*/
  function sw_get_current_weekday() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    return date('d-m-Y H:m:s');
  }

  public function test () {
    return 'hoang thuong gia lam.';
  }
}   
?>