<?php 
/**
* 
*/
include_once dirname(__FILE__).DIR_FUNCTIONS."library.php";
include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."Pagination.php";

class action_menu_new extends library
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }

	/*---------- Liet ke tat ca Menu theo thu tu tang dan ------------*/
    public function getListMainMenu_byOrderASC(){
        global $conn_vn;
        
        $stateOrder_menu='ASC';

        $rows = array();
        $sql = "SELECT * FROM $this->nameTable_menu where $this->nameColStateMain_menu = '1'  order by $this->nameColOrder_menu $stateOrder_menu"; 
        // echo $sql;       
        $result = mysqli_query($conn_vn,$sql);
        while($row = mysqli_fetch_array($result)){
                $rows[] = $row;
                // echo $row['menu_name'];
        }
        return $rows;
    }

    /*-----------------------------*/
    public function showMenu_byMultiLevel_mainMenuTraiCam($list_menu,$valParent_menu = 0,$lang, $level = 0){
        $cate_child = array();
        foreach ($list_menu as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item[$this->nameColParent_menu] == $valParent_menu)
            {
                $cate_child[] = $item;
                // Xóa chuyên mục đã lặp
                unset($list_menu[$key]);
            }
        }
        if ($cate_child) {    
            echo '<ul class="list_main_menu_'.($level+1).'">';            
            foreach ($cate_child as $key => $item) {
                //if((($level+1) == 2)&($item[$this->nameColID_menu] == 94 )) echo '<div class="coverSubMenu">';
                $row = $this->getMenuLanguageDetail_byId($item[$this->nameColID_menu],$lang);
                $name = $row[$this->nameColTitle_menuLanguage];
                $url = $this->setUrlFriendly_byType($row[$this->nameColIdMenu_menuLanguage],$lang);                
                 
                if($level == 0 && $row[$this->nameColTitle_menuLanguage] == "Trang chủ")
                  echo '<li class="active_mainMenu item_main_menu_'.($level+1).'">'; 
                else
                    if($level == 0 && $row[$this->nameColTitle_menuLanguage] != "Trang chủ")
                        echo '<li class="item_main_menu_'.($level+1).'">'; 
                    else    
                        echo '<li class="item_main_menu_'.($level+1).'">'; 
                 echo '<a href="'.$url.'" class="link_main_menu_'.($level+1).'">'.$row[$this->nameColTitle_menuLanguage].'</a>';
                    $this->showMenu_byMultiLevel_mainMenuTraiCam($list_menu,$item[$this->nameColID_menu],$lang, $level+1);                
                echo '</li>';            
            }
            echo '</ul>';        
        } 
    }
    /*-----------------------------*/

    /*---------- Lấy thông tin chi tiết của từng menu trong table Menu Language---------------*/
    public function getMenuLanguageDetail_byId($valueCol_id,$lang){
        global $conn_vn;

        $sql = "SELECT * from $this->nameTable_menuLanguage where ($this->nameColIdMenu_menuLanguage = '".$valueCol_id."') and ($this->nameColType_menuLanguage = '".$lang."') limit 1";
        
        $result = mysqli_query($conn_vn,$sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }

     /*--------- Tạo đường dẫn thân thiện phân theo loại đường dẫn -----------------*/
    public function setUrlFriendly_byType($id_menu,$lang){
        global $conn_vn;
        //$url = '';

        $rowMenu = $this->getMenuDetail_byId($id_menu);
        $rowMenuLanguage = $this->getMenuLanguageDetail_byId($id_menu,$lang);

        $rowMenuTypeLanguage = $this->getMenuTypeLanguageDetail_byId($rowMenu[$this->nameColTypeId_menu],$lang);

        switch ($rowMenu[$this->nameColTypeId_menu]) {
            case '1': // trang chủ
                $url = '/'.$rowMenuTypeLanguage[$this->nameColUrl_menuTypeLanguage];
                break;

            case '2': // tất cả các sản phẩm
                $url = '/'.$rowMenuTypeLanguage[$this->nameColUrl_menuTypeLanguage];
                break;    

            case '3': // danh mục SẢN PHẨM cụ thể
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_productCatLanguage,$this->nameColIdProductCat_productCatLanguage,$rowMenu[$this->nameColProductCatId_menu],$this->nameColType_productCatLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrlProductCat_productCatLanguage]; 
                break;  
            case '4': // san pham cu the
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_productLanguage,$this->nameColIdProduct_productLanguage,$rowMenu[$this->nameColProductId_menu],$this->nameColType_productLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrlProduct_productLanguage]; 
              break;
            case '6': // tat ca tin tuc
                $url = '/'.$rowMenuTypeLanguage[$this->nameColUrl_menuTypeLanguage];
                break;  
            case '5': //danh muc tin tuc
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_newsCatLanguage,$this->nameColIdNewsCat_newsCatLanguage,$rowMenu[$this->nameColNewsCatId_menu],$this->nameColType_newsCatLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrlNewsCat_newsCatLanguage]; 
                break;          
            case '7': //bai viet tin tuc
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_newsLanguage ,$this->nameColIdNews_newsLanguage,$rowMenu[$this->nameColNewsId_menu],$this->nameColType_newsLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrlNews_newsLanguage];                
                break;

            case '8': // dia chi web
                $url = '/'.$rowMenuLanguage[$this->nameColUrl_menuLanguage];
                break; 
                
            case '10': // tat ca DỊCH VỤ
                $url = '/'.$rowMenuTypeLanguage[$this->nameColUrl_menuTypeLanguage];
                break;  
            case '12': //danh muc DỊCH VỤ
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_serviceCatLanguage,$this->nameColIdServiceCat_serviceCatLanguage,$rowMenu[$this->nameColServiceCatId_menu],$this->nameColType_serviceCatLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrlServiceCat_serviceCatLanguage]; 
                break;          

            case '11': //bai viet dich vu
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_serviceLanguage,$this->nameColIdService_serviceLanguage,$rowMenu[$this->nameColServiceId_menu],$this->nameColType_serviceLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrlService_serviceLanguage]; 
                break;    

            case '9': // liên hệ
                $url = '/'.$rowMenuTypeLanguage[$this->nameColUrl_menuTypeLanguage];
                break; 
            case '13': // page
                $rowItemLanguage = $this->getDetailItemLanguage_byId($this->nameTable_pageLanguage ,$this->nameColId_pageLanguage,$rowMenu[$this->nameColPageId_menu],$this->nameColType_pageLanguage,$lang);
                $url = '/'.$rowItemLanguage[$this->nameColUrl_pageLanguage]; 
                break;       

            default:
                $url = '';
        }
        return $url;
    }

     /*---------- Lấy thông tin chi tiết của từng menu trong table Menu ---------------*/
    public function getMenuDetail_byId($valueCol_id){
        global $conn_vn;

        $sql = "SELECT * from $this->nameTable_menu where $this->nameColID_menu = '".$valueCol_id."' limit 1";
        
        $result = mysqli_query($conn_vn,$sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }

     /*---------- Lấy thông tin chi tiết của từng menu trong table Menu Type Language---------------*/
    public function getMenuTypeLanguageDetail_byId($valueCol_id,$lang){
        global $conn_vn;
        $sql = "SELECT * from $this->nameTable_menuTypeLanguage where ($this->nameColIdMenuType_menuTypeLanguage = '".$valueCol_id."') and ($this->nameColType_menuTypeLanguage = '".$lang."') limit 1";
        
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
        
        $result = mysqli_query($conn_vn,$sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }
}
?>