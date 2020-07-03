
<?php 
function url_slug($str, $options = array()) {
  // Make sure string is in UTF-8 and strip invalid UTF-8 characters
  $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
  
  $defaults = array(
    'delimiter' => '-',
    'limit' => null,
    'lowercase' => true,
    'replacements' => array(),
    'transliterate' => true,
  );
  
  // Merge options
  $options = array_merge($defaults, $options);
  
  // Lowercase
  if ($options['lowercase']) {
    $str = mb_strtolower($str, 'UTF-8');
  }
  
  $char_map = array(
    // Latin
    'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'đ' => 'd', 'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y'
  );
  
  // Make custom replacements
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
  
  // Transliterate characters to ASCII
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }
  
  // Replace non-alphanumeric characters with our delimiter
  $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
  
  // Remove duplicate delimiters
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
  
  // Truncate slug to max. characters
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
  
  // Remove delimiter from ends
  $str = trim($str, $options['delimiter']);
  
  return $str;
}

function laythongtin(){
	include("../database.php");
$sql= "SELECT * FROM news order by news_id desc";
$rows=[];
      $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 while($tintuc = mysqli_fetch_array($query)){

        $rows[] = $tintuc;

    }

    return $rows;
}

function laySSR(){
  include("../database.php");
$sql= "SELECT * FROM optionsq2 order by optionsQ2_id";
$rows=[];
      $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 while($row = mysqli_fetch_array($query)){

        $rows[] = $row;

    }

    return $rows;
}
function laychitietSSR($x){
  include("../database.php");
  $id = $x;
$sql= "SELECT * FROM optionsq2 where optionsQ2_id = $id";
$rows=[];
      // $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
  }
}

function laychitietthongtin($x){
  include("../database.php");
  $id = $x;
$sql= "SELECT * FROM news where news_id = $id";
$rows=[];
      // $query = mysqli_query($conn,$sql);
      // $tintuc= mysqli_fetch_assoc($query);
 $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
  }
};
 ?>
