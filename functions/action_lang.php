<?php 
include_once DIR_FUNCTIONS. "library.php";

class action_lang extends library
{
	public  function get_url_lang_newscat ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM $this->nameTable_newsCatLanguage Where $this->nameColType_newsCatLanguage = '$langu' And $this->nameColUrlNewsCat_newsCatLanguage = '$url'";
        $result = mysqli_query($conn_vn, $sql) or die(mysqli_error($conn_vn));
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM $this->nameTable_newsCatLanguage Where $this->nameColType_newsCatLanguage = '$lang' And $this->nameColIdNewsCat_newsCatLanguage = ".$row['newscat_id'];
        $result = mysqli_query($conn_vn, $sql) or die(mysqli_error($conn_vn));
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }

    function get_url_lang_newsDetail ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM news_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM news_languages Where languages_code = '$lang' And news_id = ".$row['news_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }

    public function get_url_lang_productcat ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM $this->nameTable_productCatLanguage Where $this->nameColType_productCatLanguage = '$langu' And $this->nameColUrlProductCat_productCatLanguage = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM $this->nameTable_productCatLanguage Where $this->nameColType_productCatLanguage = '$lang' And $this->nameColIdProductCat_productCatLanguage = ".$row['productcat_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }

    public function get_url_lang_productDetail ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM $this->nameTable_productLanguage Where $this->nameColType_productLanguage = '$langu' And $this->nameColUrlProduct_productLanguage = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM $this->nameTable_productLanguage Where $this->nameColType_productLanguage = '$lang' And $this->nameColIdProduct_productLanguage = ".$row['product_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }

    function get_url_lang_serviceCat ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM servicecat_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM servicecat_languages Where languages_code = '$lang' And servicecat_id = ".$row['servicecat_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }

    function get_url_lang_serviceDetail ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM service_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM service_languages Where languages_code = '$lang' And service_id = ".$row['service_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }

    function get_url_lang_page ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM page_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM page_languages Where languages_code = '$lang' And page_id = ".$row['page_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
}
?>