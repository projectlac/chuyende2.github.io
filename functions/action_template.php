<?php

include_once('lib/library.php');
include_once('lib/Pagination.php');
class action_template extends library{

	public $nameTable_templateCat = 'templatecat';
	public $nameColId_templateCatParent = 'templatecat_parent';
	public $nameColIdTemplateCat = 'templatecat_id';
	public $nameTable_template = 'template';
	public $nameColIdTemplateCat_template = 'templatecat_id';
	public $nameColId_template = 'template_id';
	public $nameColUrl_templateCat = 'friendly_url';

	/*------ lấy thông tin chi tiết của Template Cat từ URL ------*/
	public function getTemplateCatDetail_byId($idTemplateCat){
	    global $conn_vn;
	    $table = 'templatecat';
	    $where = "where templatecat_id = '".$idTemplateCat."'";
	    $limit = "limit 1";
	    $sql = "SELECT * from $table $where $limit";        
	    $result = mysqli_query($conn_vn,$sql);   
	    if (mysqli_num_rows($result) > 0) {
	    	$row = mysqli_fetch_assoc($result);
	    	return $row;
	    }
	}


	/*------ lấy thông tin chi tiết của Template Cat Language từ URL ------*/

	public function getTemplateCatDetail_byUrl($urlFriendly){
	    global $conn_vn;
	    $table = $this->nameTable_templateCat;
	    $where = "where $this->nameColUrl_templateCat = '".$urlFriendly."'";
	    $limit = "limit 1";
	    $sql = "SELECT * from $table $where $limit";   
	    $result = mysqli_query($conn_vn,$sql);
	    if (mysqli_num_rows($result) > 0){
	        $row = mysqli_fetch_assoc($result);
	        return $row;
	    } 
	}

	public function getTemplateList_byMultiLevel_orderTemplateId($idTemplateCat,$order_templateId,$trang, $limit, $page){
	    global $conn_vn;
	    $table = $this->nameTable_Template;
	    $nameColIdTemplateCat = $this->nameColIdTemplateCat_template;
	    $list_id = $this->getTemplateCat_byTemplateCatIdParentHighest($idTemplateCat,$order_templateId);
	    $list_id[] = $idTemplateCat;
	    $this->refreshList();
	    $list_id[] = $idTemplateCat;
	    $list_id = implode(',', $list_id);
	    if ($idTemplateCat != "" && $nameColIdTemplateCat != "") {
	        $cond = "&".$nameColIdTemplateCat."=".$idTemplateCat;
	        $where = " where templatecat_id in ($list_id)";
	    }else{
	        $cond = "";
	    }
	    if ($this->nameColId_template != "" && $order_state != "") {
	        $order = "order by $this->nameColId_Template $order_state ";
	    }
	    if ($limit != "" && $trang == '') {
	        $limit1 = "limit ".$limit;
	    }

	    $rows = array();
	    $sql = "SELECT * From $table $where $order $limit1";
	    $result = mysqli_query($conn_vn,$sql);
	    $total_record = mysqli_num_rows($result);
	    if ($trang != "" && $limit != "") {
	        $config = array(
	            'current_page'=> $trang != "" ? $trang : 1,
	            'total_record'=> $total_record,
	            'limit' => $limit,
	            'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',
	            'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page.$cond,
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

	/*----- liệt kê danh sách Template cat con cùng thuộc Template Cat Id cha yêu cầu -------*/

	public function getTemplateCat_byTemplateCatIdParentHighest($idTemplateCatParent,$order_templateCatId){
	    global $conn_vn;
	    $table = $this->nameTable_templateCat;
	    $nameColIdTemplateParent = $this->nameColId_templateCatParent;
	    $nameColIdTemplate = $this->nameColIdTemplateCat_template;

	    $list = $this->getTemplateCat_byTemplateCatIdParent($idTemplateCatParent,$order_templateCatId);
	    foreach ($list as $key => $value) {
	        $this->list_id[] = $value[$nameColIdTemplate];
	        unset($list[$key]);
	        $this->getTemplateCat_byTemplateCatIdParentHighest($value[$nameColIdTemplate],$order_templateCatId);
	    }

	    return $this->list_id;
	    $this->list_id = '';
	}

	/*----- liệt kê danh sách Template cat con dựa vào Template Cat Id cha gần nhất -------*/

	public function getTemplateCat_byTemplateCatIdParent($idTemplateCatParent,$order_templateCatId){
	    global $conn_vn;
	    $table = $this->nameTable_templateCat;
	    $nameColIdTemplateParent = $this->nameColId_templateCatParent;
	    $nameColIdTemplate = $this->nameColIdTemplateCat_template;
	    $where = "where $nameColIdTemplateParent = '".$idTemplateCatParent."' ";
	    $order = "order by $nameColIdTemplate $order_templateCatId";
	    $sql = "SELECT * From $table $where $order";
	    $result = mysqli_query($conn_vn,$sql);
	    while($row = mysqli_fetch_array($result)){
	        $rows[] = $row;
	    }
	    return $rows;
	}

	/*------ lấy thông tin các sản phẩm liên quan -----*/
    public function getListTemplateRelate_byIdCat($idTemplateCat){
        global $conn_vn;
        $table = $this->nameTable_template;
        $where = "where $this->nameColIdTemplateCat_template = '".$idTemplateCat."'";
        $sql = "SELECT * from $table $where";    
        // echo $sql;
        $result = mysqli_query($conn_vn,$sql);
        while($row = mysqli_fetch_array($result)){
            $rows[] = $row;
        }
        return $rows;
    }
}
?>