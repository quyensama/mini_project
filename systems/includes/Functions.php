<?php


/**
 * param of function show_alert
 * -Int $typeError
 *  case 1: success
 *  case 2: warning
 *  case 3: error
 *  case 4: info
 *  case 5: help
 * -array $arrAlert
*/
if ( ! function_exists('show_alert'))
{
    function show_alert($typeAlert, $arrAlert)
    {
        switch ($typeAlert) {
            case '1':
                foreach($arrAlert as $error){
                    echo '<div class="alert success">
                        <p><strong> '.$error.'.</strong></p>
                        <p><a class="alert-close" href="javascript:void(0);">Close</a></p>
                    </div>';
                }       
                break;
                    
            case '2':
                foreach($arrAlert as $error){
                    echo '  <div class="alert warning">
                            <p><strong> '.$error.'.</strong></p>
                            <p><a class="alert-close" href="javascript:void(0);">Close</a></p>
                        </div>';
                }
                break;
        
            case '3':
                foreach($arrAlert as $error){
                    echo '<div class="alert error">
                            <p><strong> '.$error.'.</strong></p>
                            <p><a class="alert-close" href="javascript:void(0);">Close</a></p>
                            </div>';
                }
                break;
            case '4':
                foreach($arrAlert as $error){
                    echo '<div class="alert info">
                            <p><strong> '.$error.'.</strong></p>
                            <p><a class="alert-close" href="javascript:void(0);">Close</a></p>
                        </div>';
                }
                break;
            case '5':
                foreach($arrAlert as $error){
                    echo '<div class="alert help">
                            <p><strong> '.$error.'.</strong> </p>
                            <p><a class="alert-close" href="javascript:void(0);">Close</a></p>
                        </div>';
                }
                break;
        }
    }
}



/**
 * param of function createPage
*/
if ( ! function_exists('createPage'))
{
    function createPage($config)
    {
        $page = '<div class="pagination">';
        $num_page   = ceil($config['total_record']/$config['limit']);
        $start      = $config['current_page'] - 2 ;
        $stop       = (int)($config['current_page'] + 2) ;
        $start      = ( $start < 1 ) ? 1 : $start ; 
        $stop       = ( $stop > $num_page ) ? $num_page : $stop ;

        if( $config['current_page'] > 1 )
        {
            if($config['current_page']>=4){
                $page .= '<a href="'.base_url().$config['link'].'1'.$config['endlink'].'" title="trang 1" class="first">first</a>';
            }
        }
        
                
        for( $i = $start ; $i <= $stop ; $i++ )
        {
            if( $i == $config['current_page'] || ( empty($config['current_page']) && $i == 1 ) )
                $page .= '<a class="current">'.$i.'</a>';
            else
                $page .= '<a href="'.base_url().$config['link'].$i.$config['endlink'].'" title="trang '.$i.'">'.$i.'</a>';
        }

        if( $config['current_page'] < $num_page )
        {
            //$page .= '<li><a href="'.__SITE_URL.$config['link'].($config['current_page']+1).'" title="trang '.($config['current_page']+1).'">next</a></li>';
            if($config['current_page'] < ($num_page - 2)){
                $page .= '<a href="'.base_url().$config['link'].$num_page.$config['endlink'].'" title="trang '.$num_page.'" class="last">last</a>';
            }
        }

        return $page.'</div>';
    }
}

/**
 * param of function show_alert
 * -Int $typeError
 *  case 1: success
 *  case 2: warning
 *  case 3: error
 *  case 4: info
 *  case 5: help
 * -array $arrAlert
*/
if ( ! function_exists('redirect'))
{
    function redirect($url = null)
    {
        if(isset($url)){
            header('Location: '.$url);
        }else{
            header('Location: '.base_url());
        }        
    }
}

if ( ! function_exists('base_url'))
{
    function base_url()
    {
        return __SITE_URL;
    }
}

if ( ! function_exists('convertString'))
{
    function convertString($string = null){
        if($string == null){
            $string          = 'ten-bai-viet';
        }else{
            $a_str = array("ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "á", "à", "ả", "ã", "ạ", "â", "ấ", "ầ", "ẩ", "ẫ", "ậ", "Á", "À", "Ả", "Ã", "Ạ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "Â", "Ấ", "Ầ", "Ẩ", "Ẫ", "Ậ" );
            $e_str = array("é","è","ẻ","ẽ","ẹ","ê","ế","ề","ể","ễ","ệ","É","È","Ẻ","Ẽ","Ẹ","Ê","Ế","Ề","Ể","Ễ","Ệ");
            $d_str = array("đ","Đ");
            $o_str = array("ó","ò","ỏ","õ","ọ","ô","ố","ồ","ổ","ỗ","ộ","ơ","ớ","ờ","ở","ỡ","ợ","Ó","Ò","Ỏ","Õ","Ọ","Ô","Ố","Ồ","Ổ","Ỗ","Ộ","Ơ","Ớ","Ờ","Ở","Ỡ","Ợ");
            $u_str = array("ú","ù","ủ","ũ","ụ","ư","ứ","ừ","ữ","ử","ự","Ú","Ù","Ủ","Ũ","Ụ","Ư","Ứ","Ừ","Ử","Ữ","Ự");
            $i_str = array("í","ì","ỉ","ị","ĩ","Í","Ì","Ỉ","Ị","Ĩ");
            $y_str = array("ý","ỳ","ỷ","ỵ","ỹ","Ý","Ỳ","Ỷ","Ỵ","Ỹ");
            $da_str = array("́","̀","̉","̃","̣");
            $string = str_replace($i_str,"i",$string);
            $string = str_replace($da_str,"",$string);
            $string = str_replace($y_str,"y",$string);
            $string = str_replace($a_str,"a",$string);
            $string = str_replace($e_str,"e",$string);
            $string = str_replace($d_str,"d",$string);
            $string = str_replace($o_str,"o",$string);
            $string = str_replace($u_str,"u",$string);
            $string=strtolower($string);
            $string=preg_replace('/[^a-z0-9]/',' ',$string);
            $string=preg_replace('/\s\s /',' ',$string);
            $string=trim($string);
            $string=str_replace(' ','-',$string);
        }
        return $string;
    }
}