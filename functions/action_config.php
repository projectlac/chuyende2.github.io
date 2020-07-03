<?php
include_once(DIR_FUNCTIONS.'/library.php');
include_once(DIR_FUNCTIONS_PAGING.'/Pagination.php');
class action_config extends library{

/*---- lấy thông tin cấu hình của website ----*/
public function getConfig_byId(){
    global $conn_vn;

    $sql = "SELECT * from $this->nameTable_config where $this->nameColId_config ='1'";
    
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

}


/*---- lấy thông tin cấu hình của website đa ngôn ngữ ----*/
public function getConfigDetail_byId($id){

    global $conn_vn;
    $sql = "SELECT * from $this->nameTable_config where $this->nameColId_config = '".$id."'";
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}
/*---- lấy thông tin cấu hình của website đa ngôn ngữ ----*/
public function getConfigLanguageDetail_byId($id,$lang){

    global $conn_vn;
    $sql = "SELECT * from $this->nameTable_configLanguage where $this->nameColId_config = '".$id."' and ($this->nameColType_configLanguage = '".$lang."')";
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

}   
?>