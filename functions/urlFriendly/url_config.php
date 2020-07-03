<?php	

    $action = new action();
	if (isset($_GET['page'])) {  
        $urlAnalytic = $action->getTypePage_byUrl($_GET['page'],$lang);                    
        $_SESSION['urlAnalytic']  = $urlAnalytic;        
        $_SESSION['slug'] = $_GET['slug'];        
    } 
    else{
        $_SESSION['urlAnalytic']  = '';        
        $_SESSION['slug'] = '';
    }

?>