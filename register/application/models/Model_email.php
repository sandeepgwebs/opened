<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_email extends CI_Model{
    public function sendEmailCI($to, $template, $array, $subjectArray = array(), $attachment = false, $method = "default"){
        if(isset($template['custom']) && $template['custom'] == true){

        }else{
            $template = $this->getData(array('template' => $template), true);
        }
        
        if($template){
            $message		=	$template['message'];

            foreach($array as $find => $replace){
                $message		=	str_replace($find, $replace, $message);
            }

            $subject        =   $template['subject'];
            foreach($subjectArray as $find => $replace){
                $subject		=	str_replace($find, $replace, $subject);
            }

            $emailConfig['mailtype']        =   'html';

            if($method == "default"){
                $this->load->library('email', $emailConfig);
                $this->email->from($this->config->item('admin_email'), $this->config->item('project_name'));
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);

                if($attachment){
                    if(is_array($attachment)){
                        foreach($attachment as $key => $attach){
                            $this->email->attach($attach);
                        }
                    }else{
                        $this->email->attach($attachment);
                    }
                }

                if($this->email->send()){
                    return true;
                }else{
                    var_dump($this->email->print_debugger() );die;
                    return false;
                }
            }else if($method == "elastic"){
                // sending email by elastic email
                $url = 'https://api.elasticemail.com/v2/';
                $apiKey = '015b2b7f-c914-4a4e-b921-4bb4d4f14b97';

                // upload if attachment
                $attachmentIDs = false;
                if($attachment){
                    if(is_array($attachment)){
                        foreach($attachment as $key => $attach){
                            $getParams = array(
                                'apikey'    =>  $apiKey,
                                'name' => $attach['fileName']
                            );
                            $params['attachments'] =   '@' . realpath($attach['filePath']);
                            //$params['attachments'] =  base_url($attach);

                            $request =  $url.'file/upload';
                            $request = $request . '?' . http_build_query($getParams);

                            $attachmentResponse = $this->functions->sendcurl(array('url' => $request, 'httpHeader' => array('Content-type: multipart/form-data;')), $params);
                            $attachmentResponse = json_decode($attachmentResponse, true);

                            if($attachmentResponse){
                                if($attachmentResponse['success'] == true){
                                    $attachmentIDs[] = $attachmentResponse['data']['fileid'];
                                }
                            }
                        }
                    }
                }


                $getParams = array(
                    'apikey'    =>  $apiKey,
                    'msgTo'     =>  $to,
                    'subject'   =>  $subject,
                    'bodyHtml'  =>  'Test message Here',
                    /*'bodyHtml'  =>  $message,*/
                    'from'      =>  $this->config->item('admin_email'),
                    'fromName'  =>  $this->config->item('project_name'),
                    'isTransactional'   =>  true,
                    /*'attachments'   =>  'samplepdf.pdf',*/
                );

                $params = array();
               /* if($attachmentIDs){
                    $getParams['attachments'] = join(';', $attachmentIDs);
                }*/

                $request =  $url.'email/send';

                $request = $request . '?' . http_build_query($getParams);
                var_dump($request);

                $response = $this->functions->sendcurl(array('url' => $request, 'httpHeader' => array('Content-type: multipart/form-data;')), $params);

                return $response;
            }


        }else{
            return false;
        }
    }

    public function insert($data){
        $query_data    =   array(
            'template'      =>      $data['template'],
            'subject'       =>      $data['subject'],
            'message'       =>      $data['message']
        );

        $status = $this->db->insert('tbl_email_template', $query_data);
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function delete($data){
        $status = $this->db->delete('tbl_email_template', array('id' => $data['id']));
        if($status){
            return true;
        }else{
            return false;
        }
    }

    public function update($data){
        $query_data    =   array(
            'template'      =>      $data['template'],
            'subject'       =>      $data['subject'],
            'message'       =>      $data['message']
        );

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_email_template', $query_data);

    }

    public function getData($data, $getRow = false){
        $sql    =   "select * from `tbl_email_template` where 1";

        if(isset($data['id']) && $data['id'] != ""){
            $sql .= " and id = " . $data['id'];
        }
        if(isset($data['template']) && $data['template'] != ""){
            $sql .= " and `template` = '" . $data['template'] . "'";
        }

        $result      =   $this->db->query($sql);

        if($result->num_rows() > 0){
            if($getRow){
                return $result->row_array();
            }else{
                return $result->result_array();
            }
        }else{
            return false;
        }
    }
}