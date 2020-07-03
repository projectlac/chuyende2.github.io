

<?php

// ******************************* INFORMATION ***************************//

// ***********************************************************************//
//  
// ** NAME - A description of what the file does. 
// ** 
// ** @author   name <name@name.com>
// ** @date date
// ** @access   private
// ** @param    
// ** @return   if a class what object is returned 
//      
// ***********************************************************************//

include_once dirname(__FILE__).DIR_FUNCTIONS."library.php";
include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."Pagination.php";

class action_product extends library{


// ********* START - NHỮNG HÀM CƠ SỞ DÙNG THAO TÁC DỮ LIỆU VỚI PRODUCT *************//   

/*------ lấy thông tin chi tiết của product Cat từ URL ------*/
public function getProductCatDetail_byId($idProductCat,$lang){

    global $conn_vn;

    $table = $this->nameTable_productCat;

    $where = "where $this->nameColId_productCat = '".$idProductCat."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        

    //echo $sql;

    $result = mysqli_query($conn_vn,$sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        return $row;

    }

}

/*------ lấy thông tin chi tiết của product Cat Language từ URL ------*/
public function getProductCatLangDetail_byUrl($urlFriendly,$lang){

    global $conn_vn;

    $table = $this->nameTable_productCatLanguage;

    $where = "where $this->nameColUrlProductCat_productCatLanguage = '".$urlFriendly."' and $this->nameColType_productCatLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";  

    // echo $sql;      

    $result = mysqli_query($conn_vn,$sql);

    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}


/*------ lấy thông tin chi tiết của Product Language từ URL ------*/
public function getProductLangDetail_byUrl($urlFriendly,$lang){
    global $conn_vn;
    $table = $this->nameTable_productLanguage;
    $where = "where $this->nameColUrlProduct_productLanguage = '".$urlFriendly."' and $this->nameColType_productLanguage = '".$lang."'";
    $limit = "limit 1";
    $sql = "SELECT * from $table $where $limit";   
    // echo $sql;     
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 

}

/*------ lấy thông tin chi tiết của Product Language từ URL ------*/
public function getProductLangDetail_byId($idProduct,$lang){
    global $conn_vn;
    $table = $this->nameTable_productLanguage;
    $where = "where $this->nameColIdProduct_productLanguage = '".$idProduct."' and $this->nameColType_productLanguage = '".$lang."'";
    $limit = "limit 1";
    $sql = "SELECT * from $table $where $limit";        
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 

}    

/*------ lấy thông tin chi tiết của Product tu Id ------*/
public function getProductDetail_byId($idProduct,$lang){
    global $conn_vn;
    $table = $this->nameTable_product;
    $where = "where $this->nameColId_product = '".$idProduct."'";
    $limit = "limit 1";
    $sql = "SELECT * from $table $where $limit";    
    $result = mysqli_query($conn_vn,$sql);    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

}

/*------ lấy thông tin chi tiết của product Cat Language từ URL ------*/
public function getProductCatLangDetail_byId($idProductCat,$lang){

    global $conn_vn;


    $table = $this->nameTable_productCatLanguage;

    $where = "where $this->nameColIdProductCat_productCatLanguage = '".$idProductCat."' and $this->nameColType_productCatLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";

    $result = mysqli_query($conn_vn,$sql);

    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}

/*---------- Lấy thông tin chi tiết của từng menu trong table Producer Language---------------*/
public function getProducerLanguageDetail_byId($valueCol_id,$lang){
    global $conn_vn;

    $sql = "SELECT * from $this->nameTable_producerLanguage where ($this->nameColIdProducer_producerLanguage = '".$valueCol_id."') and ($this->nameColType_producerLanguage = '".$lang."') limit 1";
    //echo $sql;
    
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

/*-------- Lấy thông tin cụ thể từ các bảng khác xxxLanguages table (# menu và # menu Language)    ----*/
public function getDetailItemLanguage_byId($nameTable_item,$nameColId_item,$valId_item,$nameColTypelang_item,$lang){

    global $conn_vn;

    $sql = "SELECT * from $nameTable_item where ($nameColId_item = '".$valId_item."') and ($nameColTypelang_item = '".$lang."') limit 1";
    //echo $sql;
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

/*------ lấy thông tin chi tiết của product Cat Language từ URL ------*/
public function getProducerLangDetail_byUrl($urlFriendly,$lang){

    global $conn_vn;

    $table = $this->nameTable_producerLanguage;

    $where = "where $this->nameColUrlProducer_producerLanguage = '".$urlFriendly."' and $this->nameColType_producerLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";  
    //echo $sql;      

    $result = mysqli_query($conn_vn,$sql);



    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}  

/*------ lấy thông tin chi tiết của product Cat từ URL ------*/
public function getProducerDetail_byId($idProducer,$lang){

    global $conn_vn;

    $table = $this->nameTable_producer;

    $where = "where $this->nameColId_producer = '".$idProducer."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        
    //echo $sql;

    $result = mysqli_query($conn_vn,$sql);

    

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        return $row;

    }

}

// ********* END - NHỮNG HÀM CƠ SỞ DÙNG THAO TÁC DỮ LIỆU VỚI PRODUCT *************//

// ********* START - SHOW MENU ĐA CẤP THEO DANH MỤC SẢN PHẨM *************************//

/*---------- Liet ke tat ca Product Cat theo thu tu tang dan ------------*/
public function getListProductCat_byOrderASC(){
    global $conn_vn;
    
    $stateOrder_productCat='ASC';
    $rows = array();
    $sql = "SELECT * FROM $this->nameTable_productCat where $this->nameColStateProductCat_productCat = '1'  order by $this->nameColOrder_productCat $stateOrder_productCat";  
        
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
            $rows[] = $row;
    }
    return $rows;
}

/*--------- Hien thi menu productCat da cap -----------------*/
public function showProductCat_byMultiLevel($list_productCat,$valParent_productCat = 0,$lang, $level = 0){

    $cate_child = array();

    foreach ($list_productCat as $key => $item)
    {           
        // Nếu là chuyên mục con thì hiển thị
        if ($item[$this->nameColParent_productCat] == $valParent_productCat)
        {
            //echo $item[$this->nameColParent_productCat] ;
            $cate_child[] = $item;
            // Xóa chuyên mục đã lặp
            unset($list_productCat[$key]);
        }
    }

    // if ($cate_child) {
    //     echo '<ul class="list-unstyled menu-'.($level+1).'">';
    //     foreach ($cate_child as $key => $item) {
            
    //         $row = $this->getProductCatLanguageDetail_byId($item[$this->nameColID_productCat],$lang);
    //         $name = $row[$this->nameColTitle_productCatLanguage];
    //         $url = $this->setUrlFriendly_byType($row[$this->nameColIdProductCat_productCatLanguage],$lang);
    //         echo '<li>';
    //             echo '<a href="'.$url.'" title="" >'.$row[$this->nameColTitle_productCatLanguage].'</a>';
    //             $this->showProductCat_byMultiLevel($list_productCat,$item[$this->nameColID_productCat],$lang, $level+1);
    //         echo '</li>';
    //     }
    //     echo '</ul>';
    // } 

    if ($cate_child) {
        echo '<ul class="listProduct_Module_Bar_4">';
        foreach ($cate_child as $key => $item) {
            //echo $item[$this->nameColTitle_productCat];
            $row = $this->getProductCatLangDetail_byId($item[$this->nameColId_productCat],$lang);
            $name = $row[$this->nameColTitle_productCatLanguage];
            $url = $this->setUrlFriendly_byProductCat($row[$this->nameColIdProductCat_productCatLanguage],$lang);
            echo '<li>';
                echo '<a href="'.$url.'" title="" >'.$row[$this->nameColTitle_productCatLanguage].'</a>';
                $this->showProductCat_byMultiLevel($list_productCat,$item[$this->nameColId_productCat],$lang, $level+1);
            echo '</li>';
        }
        echo '</ul>';
    }
}

/*--------- Tạo đường dẫn thân thiện phân theo loại đường dẫn -----------------*/
public function setUrlFriendly_byProductCat($id_productCat,$lang){
    // global $conn_vn;
    
    $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_productCatLanguage,$this->nameColIdProductCat_productCatLanguage,$id_productCat,$this->nameColType_productCatLanguage,$lang);
    $url = '/'.$rowItemLanguage[$this->nameColUrlProductCat_productCatLanguage]; 

    return $url;
}

// ********* END - SHOW MENU ĐA CẤP THEO DANH MỤC SẢN PHẨM *************************//

// ********* START - SHOW HẾT TẤT CẢ NHỮNG PRODUCT CÙNG CATALOG *******************//

/*----- liệt kê danh sách product đa cấp dựa vào Product Cat Id cao nhất -------*/
public function getProductList_byMultiLevel_orderProductId($idProductCat,$order_productId,$trang, $limit, $page){

    global $conn_vn;

    $table = $this->nameTable_product;

    $nameColIdProductCat = $this->nameColIdProductCat_product;


    //$list_id = $this->getListChild('productcat', 'productcat_parent', $idProductCat, 'productcat_id', 'productcat_id', 'desc');

    $list_id = $this->getProductCat_byProductCatIdParentHighest($idProductCat,$order_productId);

    $list_id[] = $idProductCat;

    $this->refreshList();

    $list_id[] = $idProductCat;

    // $list_id = implode(',', $list_id);
    // $list_id = explode(',', $list_id);
    $whereClause = "where 1=0"; 
    foreach ($list_id as $key => $val) {
        $whereClause =$whereClause." OR productcat_ar like '%" .$val.",%' OR productcat_ar like '%," .$val."%'";
        // echo $val;
    }
    // echo $whereClause;
    // echo $list_id;


    /*************************************/
    // $product_cat = array();
    // if ($list_id) {
    //     foreach ($list_id as $key => $val) {
    //         $product_cat[] = json_encode(array('product_cat'=>$val));
    //     }
    // }
    // $product_cat = json_encode($product_cat);
    // echo $product_cat;
    /*************************************/
   



    if ($idProductCat != "" && $nameColIdProductCat != "") {

        $cond = "&".$nameColIdProductCat."=".$idProductCat;

        // $where = " where productcat_id in ($list_id)";
        $where = $whereClause;

    }else{

        $cond = "";

    }

    if ($this->nameColId_product != "" && $order_state != "") {

        $order = "order by $this->nameColId_product $order_state ";

    }

    if ($limit != "" && $trang == '') {

        $limit1 = "limit ".$limit;

    }


    // if ($price1 != '' && $price2 != '') {

    //     $between = 'and between '.$price1.' and '.$price2;

    // }

    $rows = array();

    $sql = "SELECT * From $table $where $order $limit1";
    // echo $sql;

    $result = mysqli_query($conn_vn,$sql);

    $total_record = mysqli_num_rows($result);

    if ($trang != "" && $limit != "") {

        $config = array(

            'current_page'=> $trang != "" ? $trang : 1,

            'total_record'=> $total_record,

            'limit' => $limit,

            // 'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',

            // 'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page.$cond,

            'link_full'=> $slug != '' ? $slug.'/{trang}' : '/'.$page.'/{trang}',

            'link_first'=> $slug != '' ? $slug : '/'.$page,

            'range'=> 3

        );

        $paging = new Pagination();

        $paging->init($config);

        $start = $paging->_config['start'];

        $limit = $paging->_config['limit'];

        $sql = "SELECT * from $table $where $order limit $start, $limit";

        // echo $sql;

        $result = mysqli_query($conn_vn,$sql);

        while($row = mysqli_fetch_array($result)){

            $rows[] = $row;

        }

        $p = $paging->htmlPaging();

        $rows1 = array("data"=>$rows, "paging"=>$p);

        return $rows1;

    }else{

        while($row = mysqli_fetch_array($result)){

            $rows[] = $row;

        }

        return $rows;

    }

}


/*----- liệt kê danh sách product cat con cùng thuộc Product Cat Id cha yêu cầu -------*/
public function getProductCat_byProductCatIdParentHighest($idProductCatParent,$order_productCatId){

    global $conn_vn;

    $table = $this->nameTable_productCat;

    $nameColIdProductParent = $this->nameColId_productCatParent;

    $nameColIdProduct = $this->nameColIdProductCat_product;

    //$list = $this->getList($table, $nameColIdProductParent, $idProductCatParent, $nameColIdProduct, $order_productCatId, '', '', '');

    $list = $this->getProductCat_byProductCatIdParent($idProductCatParent,$order_productCatId);

    foreach ($list as $key => $value) {

        $this->list_id[] = $value[$nameColIdProduct];

        unset($list[$key]);

        $this->getProductCat_byProductCatIdParentHighest($value[$nameColIdProduct],$order_productCatId);

    }

    return $this->list_id;

    $this->list_id = '';

}



/*----- liệt kê danh sách product cat con dựa vào Product Cat Id cha gần nhất -------*/
public function getProductCat_byProductCatIdParent($idProductCatParent,$order_productCatId){

    global $conn_vn;

    $table = $this->nameTable_productCat;

    $nameColIdProductParent = $this->nameColId_productCatParent;

    $nameColIdProduct = $this->nameColIdProductCat_product;



    $where = "where $nameColIdProductParent = '".$idProductCatParent."' ";

    $order = "order by $nameColIdProduct $order_productCatId";

    $sql = "SELECT * From $table $where $order";

    $result = mysqli_query($conn_vn,$sql);



    while($row = mysqli_fetch_array($result)){

        $rows[] = $row;

    }

    return $rows;

}

/*----- Lấy danh mục sản phẩm trang chủ có giới hạn số danh mục - Created date: 06-04-2018 by Forever Love -------*/
public function getProductCat_byProductCatIdParent_Limit($idProductCatParent,$order_productCatId, $limit){

    global $conn_vn;

    $table = $this->nameTable_productCat;

    $nameColIdProductParent = $this->nameColId_productCatParent;

    $nameColIdProduct = $this->nameColIdProductCat_product;



    $where = "where $nameColIdProductParent = '".$idProductCatParent."' ";

    $order = "order by $nameColIdProduct $order_productCatId";

    $limit = "limit $limit";

    $sql = "SELECT * From $table $where $order $limit";
    // echo $sql;die;

    $result = mysqli_query($conn_vn,$sql);



    while($row = mysqli_fetch_array($result)){

        $rows[] = $row;

    }

    return $rows;

}

/*----- Lấy danh mục sản phẩm trang chủ có giới hạn số danh mục - Created date: 07-04-2018 by Forever Love -------*/
public function getProductCat_byProductCatIdParent_Limit_HT($idProductCatParent,$order_productCatId, $start,$end){

    global $conn_vn;

    $table = $this->nameTable_productCat;

    $nameColIdProductParent = $this->nameColId_productCatParent;

    $nameColIdProduct = $this->nameColIdProductCat_product;



    $where = "where $nameColIdProductParent = '".$idProductCatParent."' ";

    $order = "order by $nameColIdProduct $order_productCatId";

    $limit = "limit $start, $end";

    $sql = "SELECT * From $table $where $order $limit";
    // echo $sql;die;

    $result = mysqli_query($conn_vn,$sql);



    while($row = mysqli_fetch_array($result)){

        $rows[] = $row;

    }

    return $rows;

}

/*------ kiểm tra productcat hiện tại có productcat con không? ------*/
public function getListProductCatSub($urlFriendly,$lang){

    global $conn_vn;

    $rowCatLang = $this->getProductCatLangDetail_byUrl($urlFriendly,$lang);

    $idProductCat = $rowCatLang[$this->nameColIdProductCat_productCatLanguage];

    $table = $this->nameTable_productCat;

    $where = "where $this->nameColId_productCatParent = '".$idProductCat."'";

    $sql = "SELECT * from $table $where limit 1";
    $result = mysqli_query($conn_vn,$sql);

    return mysqli_num_rows($result);

    // if (mysqli_num_rows($result) > 0) {

    //     $row = mysqli_fetch_assoc($result);        

    // }
    // return $row;

}

// ********* END - SHOW HẾT TẤT CẢ NHỮNG PRODUCT CÙNG CATALOG *******************//



// ********* START - SHOW MENU ĐA CẤP THEO NHÀ SẢN XUẤT *************************//

/*---------- Liet ke tat ca Producer theo thu tu tang dan ------------*/
public function getListProducer_byOrderASC(){
    global $conn_vn;
    
    $stateOrder_producer='ASC';

    $rows = array();
    $sql = "SELECT * FROM $this->nameTable_producer where $this->nameColStateProducer_producer = '1'  order by $this->nameColOrder_producer $stateOrder_producer";  
    //echo $sql;      
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
            $rows[] = $row;
    }
    return $rows;
}

/*--------- Hien thi menu producer da cap -----------------*/
public function showProducer_byMultiLevel($list_producer,$valParent_producer = 0,$lang, $level = 0){

    $cate_child = array();

    foreach ($list_producer as $key => $item)
    {        	
        // Nếu là chuyên mục con thì hiển thị
        if ($item[$this->nameColParent_producer] == $valParent_producer)
        {
            $cate_child[] = $item;
            // Xóa chuyên mục đã lặp
            unset($list_producer[$key]);
        }
    }

    // if ($cate_child) {
    //     echo '<ul class="list-unstyled menu-'.($level+1).'">';
    //     foreach ($cate_child as $key => $item) {
            
    //         $row = $this->getProducerLanguageDetail_byId($item[$this->nameColID_producer],$lang);
    //         $name = $row[$this->nameColTitle_producerLanguage];
    //         $url = $this->setUrlFriendly_byType($row[$this->nameColIdProducer_producerLanguage],$lang);
    //         echo '<li>';
    //             echo '<a href="'.$url.'" title="" >'.$row[$this->nameColTitle_producerLanguage].'</a>';
    //             $this->showProducer_byMultiLevel($list_producer,$item[$this->nameColID_producer],$lang, $level+1);
    //         echo '</li>';
    //     }
    //     echo '</ul>';
    // } 

    if ($cate_child) {
        echo '<ul class="listProduct_Module_Bar_4">';
        foreach ($cate_child as $key => $item) {
            //echo $item[$this->nameColTitle_producer];
            $row = $this->getProducerLanguageDetail_byId($item[$this->nameColId_producer],$lang);
            $name = $row[$this->nameColTitle_producerLanguage];
            $url = $this->setUrlFriendly_byProducer($row[$this->nameColIdProducer_producerLanguage],$lang);
            echo '<li>';
                echo '<a href="'.$url.'" title="" >'.$row[$this->nameColTitle_producerLanguage].'</a>';
                $this->showProducer_byMultiLevel($list_producer,$item[$this->nameColId_producer],$lang, $level+1);
            echo '</li>';
        }
        echo '</ul>';
    }
}

/*--------- Tạo đường dẫn thân thiện phân theo loại đường dẫn -----------------*/
public function setUrlFriendly_byProducer($id_producer,$lang){
    // global $conn_vn;
    
    $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_producerLanguage,$this->nameColIdProducer_producerLanguage,$id_producer,$this->nameColType_producerLanguage,$lang);
    $url = '/'.$rowItemLanguage[$this->nameColUrlProducer_producerLanguage]; 

    return $url;
}

// ********* END - SHOW MENU ĐA CẤP THEO NHÀ SẢN XUẤT *************************//


// ********* START - LIỆT KÊ HẾT NHỮNG SẢN PHẨM CÙNG THUỘC NHÀ SẢN XUẤT *************************//

/*----- liệt kê danh sách product đa cấp dựa vào Producer Id cao nhất -------*/
public function getProductList_byMultiLevelProducer_orderProductId($idProducer,$order_productId,$trang, $limit, $page){

    global $conn_vn;

    $table = $this->nameTable_product;

    $nameColIdProducer = $this->nameColId_producer;    

    $list_id = $this->getProducer_byProducerIdParentHighest($idProducer,$order_productId);

    $list_id[] = $idProducer;

    $this->refreshList();

    $list_id[] = $idProducer;

    $list_id = implode(',', $list_id);



    if ($idProducer != "" && $nameColIdProducer != "") {

        $cond = "&".$nameColIdProducer."=".$idProducer;

        $where = " where product_producer in ($list_id)";

    }else{

        $cond = "";

    }

    if ($this->nameColId_product != "" && $order_state != "") {

        $order = "order by $this->nameColId_product $order_state ";

    }

    if ($limit != "" && $trang == '') {

        $limit1 = "limit ".$limit;

    }



    // if ($price1 != '' && $price2 != '') {

    //     $between = 'and between '.$price1.' and '.$price2;

    // }



    $rows = array();

    $sql = "SELECT * From $table $where $order $limit1";
    //echo $sql;

    $result = mysqli_query($conn_vn,$sql);

    $total_record = mysqli_num_rows($result);

    if ($trang != "" && $limit != "") {

        $config = array(

            'current_page'=> $trang != "" ? $trang : 1,

            'total_record'=> $total_record,

            'limit' => $limit,

            // 'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',

            // 'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page.$cond,

            'link_full'=> $slug != '' ? $slug.'/{trang}' : '/'.$page.'/{trang}',

            'link_first'=> $slug != '' ? $slug : '/'.$page,

            'range'=> 3

        );

        $paging = new Pagination();

        $paging->init($config);

        $start = $paging->_config['start'];

        $limit = $paging->_config['limit'];

        $sql = "SELECT * from $table $where $order limit $start, $limit";
        //echo $sql;


        $result = mysqli_query($conn_vn,$sql);

        while($row = mysqli_fetch_array($result)){

            $rows[] = $row;

        }

        $p = $paging->htmlPaging();

        $rows1 = array("data"=>$rows, "paging"=>$p);

        return $rows1;

    }else{

        while($row = mysqli_fetch_array($result)){

            $rows[] = $row;

        }

        return $rows;

    }

}

/*----- liệt kê danh sách producer con cùng thuộc Producer Id cha yêu cầu -------*/
public function getProducer_byProducerIdParentHighest($idProducerParent,$order_productId){

    global $conn_vn;

    $table = $this->nameTable_producer;

    $nameColIdProducerParent = $this->nameColParent_producer;

    $nameColIdProducer = $this->nameColId_producer;

    //$list = $this->getList($table, $nameColIdProductParent, $idProductCatParent, $nameColIdProduct, $order_productCatId, '', '', '');

    $list = $this->getProducer_byProducerIdParent($idProducerParent,$order_productId);

    foreach ($list as $key => $value) {

        $this->list_id[] = $value[$nameColIdProducer];

        unset($list[$key]);

        $this->getProducer_byProducerIdParentHighest($value[$nameColIdProducer],$order_productId);

    }

    return $this->list_id;

    $this->list_id = '';

}

/*----- liệt kê danh sách product cat con dựa vào Product Cat Id cha gần nhất -------*/
public function getProducer_byProducerIdParent($idProducerParent,$order_producerId){

    global $conn_vn;

    $table = $this->nameTable_producer;

    $nameColIdProducerParent = $this->nameColParent_producer;

    $nameColIdProducer = $this->nameColId_producer;



    $where = "where $nameColIdProducerParent = '".$idProducerParent."' ";

    $order = "order by $nameColIdProducer $order_productId";

    $sql = "SELECT * From $table $where $order";
    //echo $sql;

    $result = mysqli_query($conn_vn,$sql);



    while($row = mysqli_fetch_array($result)){

        $rows[] = $row;

    }

    return $rows;

}

/*------ kiểm tra producer hiện tại có producer con không? ------*/
public function getListProducerSub($urlFriendly,$lang){

    global $conn_vn;

    $rowCatLang = $this->getProducerLangDetail_byUrl($urlFriendly,$lang);

    $idProducer = $rowCatLang[$this->nameColIdProducer_producerLanguage];

    $table = $this->nameTable_producer;

    $where = "where $this->nameColParent_producer = '".$idProducer."'";

    $sql = "SELECT * from $table $where limit 1";        

    $result = mysqli_query($conn_vn,$sql);

    return mysqli_num_rows($result);

}

// ********* END - LIỆT KÊ HẾT NHỮNG SẢN PHẨM CÙNG THUỘC NHÀ SẢN XUẤT *************************//


// ********* START - CÁC HÀM KHÁC LIÊN QUAN TỚI PRODUCT *************************//

/*------ lấy thông tin các sản phẩm liên quan -----*/
public function getListProductRelate_byIdCat_hasLimit($idProductCat,$limit){
    global $conn_vn;
    $table = $this->nameTable_product;
    // $where = "where $this->nameColId_productCat = '".$idProductCat."'";
    $where = "Where productcat_ar LIKE '%$idProductCat%'";
    if ($limit == 0) $limit = "";
    else $limit = "limit ".$limit;
    $sql = "SELECT * from $table $where $limit";    
     // echo $sql;
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}



/*------ lấy thông tin các sản phẩm khuyến mãi - @tmp -----*/
public function getListProductSaleOff_hasLimit($limit){
    global $conn_vn;
    $table = $this->nameTable_product;
    $where = "where $this->nameColPriceSale_product != 0";
    $limit = "limit ".$limit;
    $sql = "SELECT * from $table $where $limit";    
    
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/*------ lấy thông tin các sản phẩm HOT - @tmp -----*/
public function getListProductHot_hasLimit($limit){
    global $conn_vn;
    $table = $this->nameTable_product;
    $where = "where $this->nameColHot_product != 0";
    $limit = "limit ".$limit;
    $sql = "SELECT * from $table $where order by product_id desc $limit";    
    
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/*------ lấy thông tin các sản phẩm MỚI - @tmp -----*/
public function getListProductNew_hasLimit($limit){
    global $conn_vn;
    $table = $this->nameTable_product;
    $where = "where $this->nameColNew_product != 0";
    $limit = "limit ".$limit;
    $sql = "SELECT * from $table $where order by product_id DESC $limit";    
    
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

// ********* END - CÁC HÀM KHÁC LIÊN QUAN TỚI PRODUCT *************************//


//******** START - CÁC HÀM TÌM KIẾM LIÊN QUAN TỚI PRODUCT *******************//

/*---- Tìm kiếm theo từ khóa -----*/
public function getListSearch($txtSearch, $trang, $limit,$page){
    global $conn_vn;
    $cond = array();
    $safe_keyword = $conn_vn->real_escape_string($txtSearch);
    // $safe_id_productCat = $this->conn_vn->real_escape_string($id_productCat);
    // $safe_id_type = $this->conn_vn->real_escape_string($id_type);
    // $safe_provinceid = $this->conn_vn->real_escape_string($provinceid);
    // $safe_districtid = $this->conn_vn->real_escape_string($districtid);
    // $safe_id_search_price = $this->conn_vn->real_escape_string($id_search_price);
    // $safe_id_search_area = $this->conn_vn->real_escape_string($id_search_area);

    $cond_page = array();
    $cond_page[] = "txtSearch=$safe_keyword";
    // $cond_page[] = "danhmuc=$safe_id_productCat";
    // $cond_page[] = "hinhthuc=$safe_id_type";
    // $cond_page[] = "tinh=$safe_provinceid";
    // $cond_page[] = "huyen=$safe_districtid";
    // $cond_page[] = "gia=$safe_id_search_price";
    // $cond_page[] = "dientich=$safe_id_search_area";

    if (!empty($txtSearch)) {
        $cond[] = "keyword like '%{$safe_keyword}%' or product_name like '%{$safe_keyword}%'";
    }

    // if (!empty($keyword)) {
    //     $cond[] = "keyword like '%{$safe_keyword}%' or name_product like '%{$safe_keyword}%' or doc_product like '%{$safe_keyword}%'";
    // }

    // if (!empty($id_productCat)) {
    //     $string = $this->getListChildIdByCat($safe_id_productCat);
    //     $cond[] = "product.id_productCat in ($string)";
    // }

    // if (!empty($id_type)) {
    //     $cond[] = "product.id_type='$safe_id_type'";
        
    // }

    // if (!empty($provinceid)) {
    //     $cond[] = "product.provinceid='$safe_provinceid'";
        
    // }

    // if (!empty($districtid)) {
    //     $cond[] = "product.districtid='$safe_districtid'";
        
    // }

    // if (!empty($id_search_price)) {
    //     $cond[] = "product.id_search_price='$safe_id_search_price'";
        
    // }

    // if (!empty($id_search_area)) {
    //     $cond[] = "product.id_search_area='$safe_id_search_area'";
        
    // }

    $cond = implode(' AND ', $cond);
    if ($cond != "") {
        $cond = " where ".$cond;
    }
    $cond_page = implode("&", $cond_page);

    //$sql = "SELECT product.*, province.name as name1, district.name as name2 FROM product inner join province on product.provinceid = province.provinceid inner join district on product.districtid = district.districtid" . $cond;

    $sql = "SELECT * FROM product " . $cond;
    
    //echo $sql;
    
    $rows = array();

    $result = mysqli_query($conn_vn,$sql);

    $total_record = mysqli_num_rows($result);

    if ($trang != "" && $limit != "") {

        $config = array(

            'current_page'=> $trang != "" ? $trang : 1,

            'total_record'=> $total_record,

            'limit' => $limit,

            // 'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',

            // 'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page.$cond,

            'link_full'=> 'search.php?'.$cond_page.'&trang={trang}',

            'link_first'=> 'search.php?'.$cond_page,

            'range'=> 3

        );

        $paging = new Pagination();

        $paging->init($config);

        $start = $paging->_config['start'];

        $limit = $paging->_config['limit'];

        $sql = "SELECT * FROM product " . $cond." limit $start, $limit";



        $result = mysqli_query($conn_vn,$sql);

        while($row = mysqli_fetch_array($result)){

            $rows[] = $row;

        }

        $p = $paging->htmlPaging();

        $rows1 = array("data"=>$rows, "paging"=>$p);

        return $rows1;

    }else{

        while($row = mysqli_fetch_array($result)){

            $rows[] = $row;

        }

        return $rows;

    }
}

/*------@tmp -- lấy thông tin 1 vài tin tức mới nhất, tính từ tin mới nhất thứ 2 -----*/
public function getSomeLastProduct_byIdCat($idProductCat,$numRecords,$fromRecord){
    global $conn_vn;
    $table = $this->nameTable_product;

    
    $where = "where $this->nameColId_productCat = '".$idProductCat."'";
    $limit = "limit ".$numRecords." offset ".$fromRecord;
    $orderby = "ORDER BY $this->nameColId_product asc";


    $sql = "SELECT * from $table $where $orderby $limit";    
    // echo $sql;
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

//******** END - CÁC HÀM TÌM KIẾM LIÊN QUAN TỚI PRODUCT *******************//


/////////////// by tuan ////////////////
// public function getProductCatLangDetail_byArr ($idProductCat, $lang) {
//     global $conn_vn;
//     $sql = "SELECT * FROM productcat INNER JOIN productcat_language";
// }






           

}


?>