<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class functions {
    var $CI;

    public function __construct(){
        // connect to database and fetch details
        $this->CI =& get_instance();
    }


    public function genPassword($len){
        $randCode='';
        $salt_chars = "abcdefghjmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWYXZ0123456789";
        $pass_len   = strlen( $salt_chars )-1;
        for ($i = 0; $i < $len; $i++) {
            $randCode .= $salt_chars[mt_rand(0,$pass_len)];
        }
        return $randCode;
    }


    public function deleteOldFiles($dir, $extention, $hours){
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if(preg_match("/^.*\.(".$extention.")$/i", $file)){
                    $fpath = $dir.'/'.$file;
                    if (file_exists($fpath)) {
                        $filelastmodified = filemtime($fpath);
                        if ( (time() - $filelastmodified ) > $hours*3600){
                            unlink($fpath);
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    public function success_message($message){
        echo '<div class="notify"><div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">x</button><p><i class="icon-remove"></i> '. $message .'</p></div></div>';
    }

    public function failed_message($message){
        echo '<div class="notify"><div class="alert alert-block alert-error fade in"><button data-dismiss="alert" class="close" type="button">x</button><p><i class="icon-remove"></i> '. $message .'</p></div></div>';
    }

    public function image_upload_config($filename = false, $directory = ""){
        $this->CI->load->helper('date');

        $config = array();
        $config['upload_path']      = $directory;
        $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']         = '0';
        $config['overwrite']        = FALSE;

        if($filename){
            $config['file_name']    = now() . "-" . $filename;
        }

        return $config;
    }
    public function file_upload_config($filename = false, $directory = "", $timestamp = false){
        $this->CI->load->helper('date');

        $config = array();
        $config['upload_path']      = $directory;
        $config['allowed_types']    = 'jpg|png|jpeg|bmp|pdf|zip|docx|doc';
        $config['max_size']         = '0';
        $config['overwrite']        = TRUE;

        if($filename){
            if($timestamp){
                $config['file_name']        = now() . "-" . mt_rand(0, 3) . "-" . $filename;
            }else{
                $config['file_name']        = $filename;
            }
        }

        return $config;
    }

    public function getField($tblname, $selector, $column, $id){
        $CI =& get_instance();
        $CI->load->library('session');
        //$CI->load->library('url');
        $CI->load->database();

        $CI->load->model('model_common');

        return $CI->model_common->getField($tblname, $selector, $column, $id);
    }

    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    function getExpectedDate($date = ""){
        if($date == ""){
            $date = date("Y-m-d");
        }

        $busDays = 2;
        $day = date("w", strtotime($date));

        if( $day > 3 && $day <= 5 ) { /* if between Wed and Fri */
            $busDays += 2; /* add 2 more days for weekend */
        }

        return date('d M, Y', strtotime($date . ' + ' . $busDays . ' days'));
    }

    function replaceChar($string, $length, $char){
        return str_repeat($char, $length - 1) . substr($string, $length, strlen($string) - $length);
    }

    function moneyFormat1($num){
        $explrestunits = "" ;
        if(strlen($num)>3){
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++){
                // creates each of the 2's group and adds a comma to the end
                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                }else{
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

    function moneyFormat($money){
        $money = explode('.', $money);
        if(isset($money[1])){
            $decimal = $money[1];
        }

        $money = $money[0];
        $len = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$len;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                $m .=',';
            }
            $m .=$money[$i];
        }
        if(isset($decimal)){
            return strrev($m) . "." . $decimal;
        }else{
            return strrev($m);
        }

    }

    function sendcurl($data, $postFields = false){
        $url    =   $data['url'];
        $curl		=	curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);

        if(isset($data['connectTimeOut'])){
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $data['connectTimeOut']);
        }else{
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,2);
        }

        if(isset($data['timeout']) && $data['timeout'] != ""){
            curl_setopt($curl, CURLOPT_TIMEOUT, $data['timeout']);
        }

        if(isset($data['httpHeader']) && $data['httpHeader'] != ""){
            curl_setopt( $curl, CURLOPT_HTTPHEADER, $data['httpHeader']);
        }
        if($postFields){
            //var_dump($postFields);die('test');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
        }
        curl_setopt($curl,CURLOPT_PROXYTYPE,CURLPROXY_HTTP);
        /*curl_setopt($curl,CURLOPT_VERBOSE,1);
        curl_setopt($curl,CURLOPT_PROXY,'http://proxy.shr.secureserver.net:3128');*/
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_ENCODING, 'identity');
        $buffer = curl_exec ($curl);
        if(!$buffer){
            $buffer = "Error: (". curl_errno($curl) . ") " . curl_error($curl);
        }
        curl_close($curl);
        return $buffer;
    }

    function generateChecksum($string, $key){
        return strtoupper(hash_hmac('sha256',$string, $key, false));
    }

    function fixPostData($data, $expectedData){
        foreach($data as $key => $value){
            if(isset($expectedData[$key])){
                if($key == "password"){
                    if($value != ""){
                        $query_data[$key] = md5($value);
                    }
                }else{
                    $query_data[$key] = $value;
                }
            }
        }
        return $query_data;
    }

    function short_content($content, $length, $start = 0){
        $content = strip_tags($content);
        $short_content = substr($content, $start, $length);

        $content_array = explode('.', $short_content);

        if(sizeof($content_array) > 1){
            $short_content = str_replace($content_array[sizeof($content_array) - 1], '', $short_content);
        }
        return trim($short_content);
    }


    function exportAll($data){
        //load our new PHPExcel library
        $this->CI->load->library('excel');
        $filename = $data['filename'];

        $count = 1;
        $character = 'A';
        foreach($data['headers'] as $head){
            $this->CI->excel->setActiveSheetIndex(0)->setCellValue("$character$count", $head);
            $character++;
        }

        $count = 2;
        foreach($data['data'] as  $row){
            $character = 'A';
            foreach($row as $key => $column){
                $this->CI->excel->setActiveSheetIndex(0)->setCellValue("$character$count", $column);
                $character++;
            }
            $count++;
        }
        /* Download in CSV format Close */
        // Rename worksheet
        $this->CI->excel->getActiveSheet()->setTitle($filename);
        $this->CI->excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename.'.xls');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
        exit;
    }

    public function do_resize($sourceFile, $targetDir){
        $config_manip = array(
            'image_library'     =>  'gd2',
            'source_image'      =>  $sourceFile,
            'new_image'         =>  $targetDir,
            'maintain_ratio'    =>  TRUE,
            'create_thumb'      =>  TRUE,
            'thumb_marker'      =>  '',
            'width'             =>  250,
            'height'            =>  250
        );
        $this->CI->load->library('image_lib', $config_manip);
        $this->CI->image_lib->initialize($config_manip);
        if (!$this->CI->image_lib->resize()) {
            echo $this->CI->image_lib->display_errors();die;
            return false;
        }else{
            return true;
        }
        $this->image_lib->clear();
    }


    public function sendGCM($data = array('message' => 'test message', 'title' => 'test title')){
        // load gcm library
        $this->CI->load->library('gcm_notification');


        // prepare options array, you can use custom key s
        $opts_array = array(
            'message'   => $data['message'],
            'title'     => $data['title'],
            'subtitle'  => 'TEST',
            'tickerText'    => 'TEST',
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );

        if(isset($data['page']) && $data['page'] != ""){
            $opts_array['page'] = $data['page'];
        }

        // place your recipients here. select gcm_id from db or smth. don't use $key=>$value

        $reg_ids = $data['regID'];

        // seting recipient
        $this->CI->gcm_notification->setRecipients($reg_ids);

        /* set Time To Live - How long (in seconds) the message should be kept on GCM storage if the device is offline.
         Optional (default time-to-live is 4 weeks, and must be set as a JSON number).*/
        $this->CI->gcm_notification->setTTL(20);

        // set collapse Key
        /*An arbitrary string (such as "Updates Available") that is used to collapse a group of like messages when the device is
         offline, so that only the last message gets sent to the client. This is intended to avoid sending too many messages to
         the phone when it comes back online.*/
        $this->CI->gcm_notification->setCollapseKey('GCM_Library');

        // takes boolean
        /*If included, indicates that the message should not be sent immediately if the device is idle. The server will wait for
        the device to become active, and then only the last message for each collapse_key value will be sent.*/
        $this->CI->gcm_notification->setDelay(true);

        // set predefined options
        $this->CI->gcm_notification->setOptions($opts_array);

        // debug info. http_headers if (400,401,500) and success if 200. takes boolean
        $this->CI->gcm_notification->setDebug(true);

        // finally send it. if DEBUG is TRUE , print , returns array
        $status = $this->CI->gcm_notification->send();

        return $status;

    }


    function generateCaptcha(){
        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
        $vals = array(
            'word' => $random_number,
            'img_path' => './images/captcha/',
            'img_url' => base_url().'images/captcha/',
            'img_width' => 150,
            'img_height' => 32,
            'expiration' => 7200
        );
        $captcha    = create_captcha($vals);

        $this->CI->session->set_userdata('captchaWord',$captcha['word']);
        return $captcha['image'];
    }



    public function logActivity($activity, $customerID){
        $this->CI->load->library('user_agent');
        $this->CI->load->model('model_activity');

        $postData = array(
            'user_id'       =>  $customerID,
            'activity'      =>  $activity,
            'user_agent'    =>  $this->CI->agent->agent_string(),
            'ip'            =>  $this->CI->input->server('REMOTE_ADDR')
        );

        return $this->CI->model_activity->insert($postData);
    }

    public function getSEOData($page){
        $this->CI->load->model('model_seo');
        if($page == "")
            $page = "/";

        $seoData = $this->CI->model_seo->getData(array('page' => $page), true);
        return $seoData;
    }

    public function get_file_extension($file_name) {
        return substr(strrchr($file_name,'.'),1);
    }

    function objectToArray2($data){
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = $this->objectToArray2($value);
            }
            return $result;
        }
        return $data;
    }

    function mc_encrypt($string, $key) {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);

        $passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, trim($string), MCRYPT_MODE_ECB, $iv));
        $encode = base64_encode($passcrypt);
        return $encode;
    }

    // Decrypt Function
    function mc_decrypt($string, $key) {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);

        $decoded = base64_decode($string);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, trim($decoded), MCRYPT_MODE_ECB, $iv));
        return $decrypted;
    }
    
    public function printResponse($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    public function concatStrings($array, $key = ','){
        $flagCount = 1;
        $string = 0;
        foreach($array as $value){
            if($value != ""){

            }
            if($flagCount == 1){

            }
            $flagCount++;
        }
    }

    public function sendSMS($message, $to){
        $apikey = "Lf6M9Gq4G0e555VSs9qZ5g";
        $apisender = "TESTIN";

        $ms = rawurlencode($message);   //This for encode your message content

        $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='. $to .'&text='.$ms.'&route=1';

        //echo $url;
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
        $data = curl_exec($ch);
        return $data;
    }
}
?>