<?php

include_once('lib/library.php');

include_once('lib/Pagination.php');

class action_service extends library{


/***************************************************************************/
/*---------------------------- service CATALOG ----------------------------*/
/***************************************************************************/



/*------ lấy thông tin chi tiết của service Cat từ URL ------*/

public function getServiceCatDetail_byId($idServiceCat,$lang){



    global $conn_vn;



    $table = $this->nameTable_serviceCat;

    $where = "where $this->nameColId_serviceCat = '".$idServiceCat."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        

    $result = mysqli_query($conn_vn,$sql);

    

    if (mysqli_num_rows($result) > 0) {

    	$row = mysqli_fetch_assoc($result);

    	return $row;

    }

}

/*------ lấy thông tin chi tiết của service Cat Language từ URL ------*/

public function getServiceCatLangDetail_byUrl($urlFriendly,$lang){



    global $conn_vn;



    $table = $this->nameTable_serviceCatLanguage;

    $where = "where $this->nameColUrlServiceCat_serviceCatLanguage = '".$urlFriendly."' and $this->nameColType_serviceCatLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        

    $result = mysqli_query($conn_vn,$sql);



    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}

/*------ lấy thông tin chi tiết của service Cat Language từ URL ------*/

public function getServiceCatLangDetail_byId($idServiceCat,$lang){



    global $conn_vn;



    $table = $this->nameTable_serviceCatLanguage;

    $where = "where $this->nameColIdServiceCat_serviceCatLanguage = '".$idServiceCat."' and $this->nameColType_serviceCatLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        

    $result = mysqli_query($conn_vn,$sql);



    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}

/*----- liệt kê danh sách service đa cấp dựa vào service Cat Id cao nhất -------*/

public function getServiceList_byMultiLevel_orderServiceId($idServiceCat,$order_serviceId,$trang, $limit, $page){



    global $conn_vn;

    $table = $this->nameTable_service;

    $nameColIdServiceCat = $this->nameColIdServiceCat_serviceCatLanguage;

    

    //$list_id = $this->getListChild('servicecat', 'servicecat_parent', $idServiceCat, 'servicecat_id', 'servicecat_id', 'desc');

    $list_id = $this->getServiceCat_byServiceCatIdParentHighest($idServiceCat,$order_serviceId);

    $list_id[] = $idServiceCat;

    $this->refreshList();

    $list_id[] = $idServiceCat;

    $list_id = implode(',', $list_id);



    if ($idServiceCat != "" && $nameColIdServiceCat != "") {

        $cond = "&".$nameColIdServiceCat."=".$idServiceCat;

        $where = " where servicecat_id in ($list_id)";

    }else{

        $cond = "";

    }

    if ($this->nameColId_service != "" && $order_state != "") {

        $order = "order by $this->nameColId_service $order_state ";

    }

    if ($limit != "" && $trang == '') {

        $limit1 = "limit ".$limit;

    }



    // if ($price1 != '' && $price2 != '') {

    //     $between = 'and between '.$price1.' and '.$price2;

    // }



    $rows = array();

    $sql = "SELECT * From $table $where $order $limit1";

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



/*----- liệt kê danh sách service cat con cùng thuộc service Cat Id cha yêu cầu -------*/

public function getServiceCat_byServiceCatIdParentHighest($idServiceCatParent,$order_serviceCatId){



    global $conn_vn;

    $table = $this->nameTable_serviceCat;

    $nameColIdServiceParent = $this->nameColId_serviceCatParent;

    $nameColIdService = $this->nameColIdServiceCat_service;



    //$list = $this->getList($table, $nameColIdserviceParent, $idserviceCatParent, $nameColIdservice, $order_serviceCatId, '', '', '');

    $list = $this->getServiceCat_byServiceCatIdParent($idServiceCatParent,$order_serviceCatId);



    foreach ($list as $key => $value) {

        $this->list_id[] = $value[$nameColIdService];

        unset($list[$key]);

        $this->getServiceCat_byServiceCatIdParentHighest($value[$nameColIdService],$order_serviceCatId);

    }

    return $this->list_id;

    $this->list_id = '';

}



/*----- liệt kê danh sách service cat con dựa vào service Cat Id cha gần nhất -------*/

public function getServiceCat_byServiceCatIdParent($idServiceCatParent,$order_serviceCatId){

    global $conn_vn;

    $table = $this->nameTable_serviceCat;

    $nameColIdServiceParent = $this->nameColId_serviceCatParent;

    $nameColIdService = $this->nameColIdServiceCat_service;



    $where = "where $nameColIdServiceParent = '".$idServiceCatParent."' ";

    $order = "order by $nameColIdService $order_serviceCatId";

    $sql = "SELECT * From $table $where $order";

    $result = mysqli_query($conn_vn,$sql);



    while($row = mysqli_fetch_array($result)){

        $rows[] = $row;

    }

    return $rows;

}

/**************************************************************/
/*** kiểm tra servicecat hiện tại có servicecat con không? ****/
/**************************************************************/
public function getListServiceCatSub($urlFriendly,$lang){

    global $conn_vn;

    $rowCatLang = $this->getServiceCatLangDetail_byUrl($urlFriendly,$lang);

    $idServiceCat = $rowCatLang[$this->nameColIdServiceCat_serviceCatLanguage];

    $table = $this->nameTable_serviceCat;

    $where = "where $this->nameColId_serviceCatParent = '".$idServiceCat."'";

    $sql = "SELECT * from $table $where limit 1";        

    $result = mysqli_query($conn_vn,$sql);

    return mysqli_num_rows($result);

    // if (mysqli_num_rows($result) > 0) {

    //     $row = mysqli_fetch_assoc($result);        

    // }
    // return $row;

}

/*------ lấy thông tin chi tiết của service Language từ URL ------*/

    public function getServiceLangDetail_byUrl($urlFriendly,$lang){
        global $conn_vn;
        $table = $this->nameTable_serviceLanguage;
        $where = "where $this->nameColUrlService_serviceLanguage = '".$urlFriendly."' and $this->nameColType_serviceLanguage = '".$lang."'";
        $limit = "limit 1";
        $sql = "SELECT * from $table $where $limit";        
        $result = mysqli_query($conn_vn,$sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row;
        } 

    }

    /*------ lấy thông tin chi tiết của service tu Id ------*/

    public function getServiceDetail_byId($idService,$lang){
        global $conn_vn;
        $table = $this->nameTable_service;
        $where = "where $this->nameColId_service = '".$idService."'";
        $limit = "limit 1";
        $sql = "SELECT * from $table $where $limit";    
        $result = mysqli_query($conn_vn,$sql);    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }

    }



    /*------ lấy thông tin chi tiết của Service Language từ URL ------*/

    public function getServiceLangDetail_byId($idService,$lang){
        global $conn_vn;
        $table = $this->nameTable_serviceLanguage;
        $where = "where $this->nameColIdService_serviceLanguage = '".$idService."' and $this->nameColType_serviceLanguage = '".$lang."'";
        $limit = "limit 1";
        $sql = "SELECT * from $table $where $limit";     
        // echo $sql;   
        $result = mysqli_query($conn_vn,$sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row;
        } 

    }    

    /*------ lấy thông tin các dịch vụ liên quan -----*/
    public function getListServiceRelate_byIdCat_hasLimit($idServiceCat,$limit){
        global $conn_vn;
        $table = $this->nameTable_service;
        $where = "where $this->nameColId_serviceCat = '".$idServiceCat."'";
        $limit = "limit ".$limit;
        $sql = "SELECT * from $table $where $limit";    
        // echo $sql;
        $result = mysqli_query($conn_vn,$sql);
        while($row = mysqli_fetch_array($result)){
            $rows[] = $row;
            // echo $row['service_id'];
        }
        return $rows;
    }
    

    /**************************************************************/
    /*** kiểm tra servicecat hiện tại có servicecat con không? ****/
    /**************************************************************/
//     public function getListServiceCatSub($urlFriendly,$lang){

//     global $conn_vn;

//     $rowCatLang = $this->getServiceCatLangDetail_byUrl($urlFriendly,$lang);

//     $idServiceCat = $rowCatLang[$this->nameColIdServiceCat_serviceCatLanguage];

//     $table = $this->nameTable_serviceCat;

//     $where = "where $this->nameColId_serviceCatParent = '".$idServiceCat."'";

//     $sql = "SELECT * from $table $where limit 1";        
//     echo $sql;

//     $result = mysqli_query($conn_vn,$sql);

//     return mysqli_num_rows($result);

//     // if (mysqli_num_rows($result) > 0) {

//     //     $row = mysqli_fetch_assoc($result);        

//     // }
//     // return $row;

// }



}















?>