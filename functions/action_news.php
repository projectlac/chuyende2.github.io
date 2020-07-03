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


include_once DIR_FUNCTIONS. "library.php";

include_once DIR_FUNCTIONS_PAGING."Pagination.php";

class action_news extends library{

// ********* START - NHỮNG HÀM CƠ SỞ DÙNG THAO TÁC DỮ LIỆU VỚI PRODUCT *************//   

/*------ lấy thông tin chi tiết của news Cat từ URL ------*/
public function getNewsCatDetail_byId($idNewsCat,$lang){
    global $conn_vn;

    $table = $this->nameTable_newsCat;

    $where = "where $this->nameColId_newsCat = '".$idNewsCat."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        

    $result = mysqli_query($conn_vn,$sql);
  

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        return $row;

    }

}

/*------ lấy thông tin chi tiết của news Cat Language từ URL @tmp------*/
public function getNewsCatLangDetail_byUrl($urlFriendly,$lang){

    global $conn_vn;

    $table = $this->nameTable_newsCatLanguage;
        
    $where = "where $this->nameColUrlNewsCat_newsCatLanguage = '".$urlFriendly."' and $this->nameColType_newsCatLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";    

    //echo $sql;      
    
    $result = mysqli_query($conn_vn,$sql);

    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}

/*------ lấy thông tin chi tiết của news Cat Language từ URL ------*/
public function getNewsCatLangDetail_byId($idNewsCat,$lang){

    global $conn_vn;

    $table = $this->nameTable_newsCatLanguage;

    $where = "where $this->nameColIdNewsCat_newsCatLanguage = '".$idNewsCat."' and $this->nameColType_newsCatLanguage = '".$lang."'";

    $limit = "limit 1";

    $sql = "SELECT * from $table $where $limit";        
    // echo $sql;
    $result = mysqli_query($conn_vn,$sql);

    if (mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        return $row;

    } 

}

/*------ lấy thông tin chi tiết của news Language từ URL ------*/
public function getNewsLangDetail_byUrl($urlFriendly,$lang){
    global $conn_vn;
    $table = $this->nameTable_newsLanguage;
    $where = "where $this->nameColUrlNews_newsLanguage = '".$urlFriendly."' and $this->nameColType_newsLanguage = '".$lang."'";
    $limit = "limit 1";
    $sql = "SELECT * from $table $where $limit";        
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 

}

/*------ lấy thông tin chi tiết của news tu Id ------*/
public function getNewsDetail_byId($idNews,$lang){
    global $conn_vn;
    $table = $this->nameTable_news;
    $where = "where $this->nameColId_news = '".$idNews."'";
    $limit = "limit 1";
    $sql = "SELECT * from $table $where $limit";    
    $result = mysqli_query($conn_vn,$sql);    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

}


/*------ lấy thông tin chi tiết của news Language từ URL ------*/
public function getNewsLangDetail_byId($idNews,$lang){
    global $conn_vn;
    $table = $this->nameTable_newsLanguage;
    $where = "where $this->nameColIdNews_newsLanguage = '".$idNews."' and $this->nameColType_newsLanguage = '".$lang."'";
    $limit = "limit 1";
    $sql = "SELECT * from $table $where $limit";  
    //echo $sql;      
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 

} 

// ********* END - NHỮNG HÀM CƠ SỞ DÙNG THAO TÁC DỮ LIỆU VỚI PRODUCT *************//   





// ********* START - SHOW HẾT TẤT CẢ NHỮNG TIN TỨC CÙNG CATALOG *******************//

/*----- liệt kê danh sách news đa cấp dựa vào news Cat Id cao nhất -------*/
public function getNewsList_byMultiLevel_orderNewsId($idNewsCat,$order_newsId,$trang, $limit, $page){



    global $conn_vn;

    $table = $this->nameTable_news;

    $nameColIdNewsCat = $this->nameColIdNewsCat_news;

    
    
    //$list_id = $this->getListChild('newscat', 'newscat_parent', $idNewsCat, 'newscat_id', 'newscat_id', 'desc');

    $list_id = $this->getNewsCat_byNewsCatIdParentHighest($idNewsCat,$order_newsId);

    $list_id[] = $idNewsCat;

    $this->refreshList();

    $list_id[] = $idNewsCat;

    $list_id = implode(',', $list_id);



    if ($idNewsCat != "" && $nameColIdNewsCat != "") {
    

        $cond = "&".$nameColIdNewsCat."=".$idNewsCat;

        $where = " where newscat_id in ($list_id)";

    }else{

        $cond = "";

    }

    $order_state = $order_newsId;
    if ($this->nameColId_news != "" && $order_state != "") {

        $order = "order by $this->nameColId_news $order_state ";

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


/*----- liệt kê danh sách news cat con cùng thuộc news Cat Id cha yêu cầu -------*/
public function getNewsCat_byNewsCatIdParentHighest($idNewsCatParent,$order_newsCatId){

    global $conn_vn;

    $table = $this->nameTable_newsCat;

    $nameColIdNewsParent = $this->nameColId_newsCatParent;

    $nameColIdNews = $this->nameColIdNewsCat_news;



    //$list = $this->getList($table, $nameColIdnewsParent, $idnewsCatParent, $nameColIdnews, $order_newsCatId, '', '', '');

    $list = $this->getNewsCat_byNewsCatIdParent($idNewsCatParent,$order_newsCatId);



    foreach ($list as $key => $value) {

        $this->list_id[] = $value[$nameColIdNews];

        unset($list[$key]);

        $this->getNewsCat_byNewsCatIdParentHighest($value[$nameColIdNews],$order_newsCatId);

    }

    return $this->list_id;

    $this->list_id = '';

}



/*----- liệt kê danh sách news cat con dựa vào news Cat Id cha gần nhất -------*/
public function getNewsCat_byNewsCatIdParent($idNewsCatParent,$order_newsCatId){

    global $conn_vn;

    $table = $this->nameTable_newsCat;

    $nameColIdNewsParent = $this->nameColId_newsCatParent;

    $nameColIdNews = $this->nameColIdNewsCat_news;



    $where = "where $nameColIdNewsParent = '".$idNewsCatParent."' ";

    $order = "order by $nameColIdNews $order_newsCatId";

    $sql = "SELECT * From $table $where $order";

    $result = mysqli_query($conn_vn,$sql);



    while($row = mysqli_fetch_array($result)){

        $rows[] = $row;

    }

    return $rows;

}

/*-------- kiểm tra newscat hiện tại có newscat con không? ------*/
public function getListNewsCatSub($urlFriendly,$lang){

    global $conn_vn;

    $rowCatLang = $this->getNewsCatLangDetail_byUrl($urlFriendly,$lang);

    $idNewsCat = $rowCatLang[$this->nameColIdNewsCat_newsCatLanguage];


    $table = $this->nameTable_newsCat;
    

    $where = "where $this->nameColId_newsCatParent = '".$idNewsCat."'";

    $sql = "SELECT * from $table $where limit 1";     



    $result = mysqli_query($conn_vn,$sql);

    return mysqli_num_rows($result);


}

// ********* END - SHOW HẾT TẤT CẢ NHỮNG TIN TỨC CÙNG CATALOG *******************//


// ********* START - CÁC HÀM KHÁC LIÊN QUAN TỚI TIN TỨC *************************//
/*------@tmp -- lấy thông tin 1 tin tức mới nhất -----*/
public function getALastNews_byIdCat($idNewsCat){
    global $conn_vn;
    $table = $this->nameTable_news;
    $limit = 1;
    $where = "where $this->nameColId_newsCat = '".$idNewsCat."'";
    $limit = "limit 1";
    $orderby = "ORDER BY $this->nameColId_news ASC";
    $sql = "SELECT * from $table $where $orderby $limit";    
    // $sql = "SELECT TOP 1 * from $table";    
    // echo $sql;
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}
/*------@tmp -- lấy thông tin 1 vài tin tức mới nhất, tính từ tin mới nhất thứ 2 -----*/
public function getSomeLastNews_byIdCat($idNewsCat,$numRecords,$fromRecord){
    global $conn_vn;
    $table = $this->nameTable_news;
    $where = "where $this->nameColId_newsCat = '".$idNewsCat."'";
    $limit = "limit ".$numRecords." offset ".$fromRecord;
    $orderby = "ORDER BY $this->nameColId_news asc";
    $sql = "SELECT * from $table $where $orderby $limit";    
    // echo $sql;
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/*------ lấy thông tin các tin tức liên quan -----*/
public function getListNewsRelate_byIdCat_hasLimit($idNewsCat,$limit){
    global $conn_vn;
    $table = $this->nameTable_news;
    $where = "where $this->nameColId_newsCat = '".$idNewsCat."'";
    $limit = "limit ".$limit;
    $sql = "SELECT * from $table $where $limit";    
    // echo $sql;
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}


/*------ lấy thông tin các tin tức HOT - @tmp -----*/
public function getListNewsHot_hasLimit($limit){
    global $conn_vn;
    $table = $this->nameTable_news;
    //$where = "where $this->nameColHot_news != 0";
    $limit = "limit ".$limit;
    //$sql = "SELECT * from $table $where $limit";    
    $sql = "SELECT * from $table $limit";    
    
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/*------ lấy thông tin các tin tức MỚI - @tmp -----*/
public function getListNewsNew_hasLimit($limit){
    global $conn_vn;
    $table = $this->nameTable_news;
    //$where = "where $this->nameColNew_news != 0";
    $limit = "limit ".$limit;
    // $sql = "SELECT * from $table $where $limit";  
    $sql = "SELECT * from $table $limit";    
    
    $result = mysqli_query($conn_vn,$sql);
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

// ********* END - CÁC HÀM KHÁC LIÊN QUAN TỚI TIN TỨC *************************//

//---------------- cua tuan ----------------

public function getListNewsCatAll ($lang) {
    global $conn_vn;
    $sql = "SELECT * From newscat INNER JOIN newscat_languages ON newscat.newscat_id = newscat_languages.newscat_id Where newscat_languages.languages_code = '$lang'";
    $result = mysqli_query($conn_vn, $sql);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

public function getListNewsLevelParent ($newscat_id, $order, $limit) {
    global $conn_vn;
    $sql = "SELECT * From news Where newscat_id = $newscat_id ORDER BY news_id $order LIMIT $limit";
    $result = mysqli_query($conn_vn, $sql);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

}















?>