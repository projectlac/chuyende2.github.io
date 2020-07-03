<?php 
	if (!isset($_SESSION['lang'])) {
		$_SESSION['lang'] = 'vn';
		$lang = 'vn';
	} else {
		$lang = $_SESSION['lang'];
	}

	switch ($lang) {
        case 'en':
            $lang_file = 'lang_en.php';
            break;
        case 'vn':
            $lang_file = 'lang_vn.php';
            break;    
        default:
        $lang_file = 'lang_vn.php';
    }

    
?>