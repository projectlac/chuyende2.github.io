<?php 
    $id = 1;    
    $action_config = new action_config();
    $rowConfig = $action_config->getConfigDetail_byId($id);
    $rowConfigLang = $action_config->getConfigLanguageDetail_byId($id,$lang);
	if (isset($urlAnalytic) && $urlAnalytic != '') {        
		switch ($urlAnalytic) {

			

            case 'productcat_languages':
                $action_productMeta = new action_product();
                if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_productMeta->getProductCatLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;

            case 'product_languages':
            	$action_productMeta = new action_product();
            	if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_productMeta->getProductLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];                    
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;
            case 'products':
                $action_productMeta = new action_product();
                if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_productMeta->getProductLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];                    
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;
           

			case 'newscat_languages':
				$action_NewsMeta = new action_news();
            	if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_NewsMeta->getNewsCatLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;

            case 'news_languages':
            	$action_NewsMeta = new action_news();
            	if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_NewsMeta->getNewsLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;

            case 'page_language':
            	$action_PageMeta = new action_page();
            	if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    // $rowLang = $action_NewsMeta->getPageLangDetail_byUrl($slug,$lang);
                    $rowLang = $action_PageMeta->getPageLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];                    
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;

            case 'lien-he-1':
            	// $title = $rowConfigLang['lang_web_name'];
             //    $meta_des = $rowConfigLang['lang_web_des'];
             //    $meta_key = $rowConfigLang['lang_web_keyword'];
                $title = $translate['contact'];
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
				break;	

            case 'gio-hang':
                $title = 'Giỏ hàng';
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
                break;

            case 'search-news':
                $title = 'Tìm kiếm tin tức';
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
                break;
            
            case 'search-product':
                $title = 'Tìm kiếm sản phẩm';
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
                break;

            case 'search-service':
                $title = 'Tìm kiếm dịch vụ';
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
                break;

			case 'dich-vu':
				$title = $rowConfigLang['lang_web_name'];
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
				break;	

			case 'servicecat_languages': 
				$action_ServiceMeta = new action_service();
            	if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_ServiceMeta->getServiceCatLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;

			case 'service_languages':
				$action_ServiceMeta = new action_service();
            	if (isset($_GET['slug']) && $_GET['slug'] != '') {
                    $slug = $_GET['slug'];
                    $rowLang = $action_ServiceMeta->getServiceLangDetail_byUrl($slug,$lang);
                    $title = $rowLang['title_seo'];
                    $meta_des = $rowLang['des_seo'];
                    $meta_key = $rowLang['keyword'];
                }
                else{
                    $title = $rowConfigLang['lang_web_name'];
                    $meta_des = $rowConfigLang['lang_web_des'];
                    $meta_key = $rowConfigLang['lang_web_keyword'];
                }
                break;         

            default:
				$title = $rowConfigLang['lang_web_name'];
                $meta_des = $rowConfigLang['lang_web_des'];
                $meta_key = $rowConfigLang['lang_web_keyword'];
				break;
            }
	}else{
		$title = $rowConfigLang['lang_web_name'];
		$meta_des = $rowConfigLang['lang_web_des'];
		$meta_key = $rowConfigLang['lang_web_keyword'];
	}

	if ($title == '') {
		$title = $rowConfigLang['lang_web_name'];
	}

	if ($meta_des == '') {
		$meta_des = $rowConfigLang['lang_web_des'];
	}

	if ($meta_key == '') {
		$meta_key =  $rowConfigLang['lang_web_keyword'];
	}


?>