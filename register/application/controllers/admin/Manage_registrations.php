<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_registrations extends CI_Controller {
    // modes = list, edit, save, delete
    public $error;
    public $pagetitle   =   "Manage Registrations";
    public $page        =   "manage_registrations";

    function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE));
        $this->load->library('user');
        $this->load->library('ckeditor');
    }

	public function index()	{
        $data               = array();

        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        $data['rows']       = $this->getlist();

        $data['list']       = $data['rows'];
        $data['mode']       = "list";

        $data['btncaption'] = "Add";
        $this->load->view('admin/manage/view_registrations', $data);
	}

    public function save(){
        $data   =   array();
        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        if($this->validate($this->input->post())) {
            $this->load->model('model_registration');
            $id = $this->input->post('id');
            if(isset($id) && $id != ""){
                $status = $this->model_registration->update($this->input->post());
            }else{
                $status = $this->model_registration->insert($this->input->post());
            }

            $data['status']     =   true;
            $data['message']    =   "Record has been Successfully Saved!";

            $data['mode']   = "save";
            $data['btncaption'] = "Add";
        }else{
            $data['status']     =   false;
            $data['message']    =   $this->error;
            $data['row']        =   $this->input->post();

            if(isset($id) && $id != ""){
                $data['mode']       = "edit";
                $data['btncaption'] = "Update";
            }else{
                $data['mode']       = "save";
                $data['btncaption'] = "Add";
            }
        }


        $this->load->model('model_registration');

        $data['rows']       = $this->getlist();
        $this->load->view('admin/manage/view_registrations', $data);
    }

    public function getlist(){
        $this->load->model('model_registration');
        $data = $this->model_registration->getData(array());
        return $data;
    }

    public function edit(){
        $data   =   array();
        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        $id =   $this->input->get('id');
        $this->load->model('model_registration');

        $row    =   $this->model_registration->getData(array('id' => $id), true);
        if($row){
            $data['row']        =   $row;
            $data['btncaption'] = "Update";
        }else{
            $data['status']     =   false;
            $data['message']    =   "Record not found!";
            $data['btncaption'] =   "Add";
        }

        $data['mode']       =   "edit";

        $data['rows']       = $this->getlist();

        $this->load->view('admin/manage/view_registrations', $data);
    }

    public function delete(){
        $data   =   array();
        $data['pagetitle']  = $this->pagetitle;
        $data['page']       = $this->page;

        $id =   $this->input->get('id');
        $this->load->model('model_registration');
        $row    =   $this->model_registration->getData(array('id' => $id), true);
        if($row){
            $delete_status  =   $this->model_registration->delete(array('id' => $id));
            if($delete_status){
                $data['status']     =   true;
                $data['message']    =   "Record Deleted!";
            }else{
                $data['status']     =   false;
                $data['message']    =   "Unable to delete this record!";
            }
        }else{
            $data['status']     =   false;
            $data['message']    =   "Record not found!";
        }

        $data['mode']       =   "delete";

        $data['rows']       = $this->getlist();
        $data['btncaption'] = "Add";
        $this->load->view('admin/manage/view_registrations', $data);

    }

    private function validate($data){
        $this->load->model('model_registration');


        if(isset($data['primary_email']) && $data['primary_email'] != ""){
            /*$row    =   $this->model_registration->getData(array('primary_email' => $data['primary_email']), true);

            if(isset($row) && $row['id'] != $data['id'] && $data['id'] != ""){
                $this->error = "Email ID already exists!";
                return false;
            }*/
        }else{
            $this->error = "Email ID can't be blank!";
            return false;
        }
        return true;
    }


    public function download(){
        $this->load->model('model_registration');
        $filter = array();
        $authors = $this->model_registration->getData($filter);

        $excelData = array();
        $excelData['filename'] = "author_data";

        $excelData['headers'] = array(
            'author_id'         =>  'Author ID',
            'fullname'          =>  'Full Name',
            'state'             =>  'State',
            'country'           =>  'Country',
            'designation'       =>  'Designation',
            'qualification'     =>  'Qualification',
            'primary_email'     =>  'Primary Email',
            'phone'             =>  'Phone',
            'website'           =>  'WebSite',
            'date_registration' =>  'Date Registration',
            'status'            =>  'Status',
        );

        $excelData['data']  =   array();

        if($authors){
            foreach($authors as $key => $author){
                $rowData = array(
                    'author_id'         =>  $author['id'],
                    'fullname'          =>  $author['firstname'] . " " . $author['middlename'] . " " . $author['lastname'],
                    'state'             =>  $author['state'],
                    'country'           =>  $author['country'],
                    'designation'       =>  $author['designation'],
                    'qualification'     =>  $author['qualification'],
                    'primary_email'     =>  $author['primary_email'],
                    'phone'             =>  $author['phone'],
                    'website'           =>  $author['website'],
                    'date_registration' =>  $author['date_register'],
                    'status'            =>  ($author['status'] == '1' ? 'Enabled' : 'Disabled'),
                );

                $excelData['data'][] = $rowData;
            }
        }

        $this->exportAll($excelData);
    }

    public function downloadEmail(){
        $this->load->model('model_registration');
        $filter = array();
        $authors = $this->model_registration->getDataPrimaryEmail($filter);

        $excelData = array();
        $excelData['filename'] = "primary_email_data";

        $excelData['headers'] = array(
            'fullname'          =>  'Full Name',
            'primary_email'     =>  'Primary Email',
            'address'           =>  'Address',
            'phone'             =>  'Phone',
        );

        $excelData['data']  =   array();

        if($authors){
            foreach($authors as $key => $author){
                $rowData = array(
                    'fullname'          =>  $author['fullname'],
                    'primary_email'     =>  $author['primary_email'],
                    'address'           =>  $author['address'],
                    'phone'             =>  $author['phone'],
                );

                $excelData['data'][] = $rowData;
            }
        }

        $this->exportAll($excelData);
    }

    private function exportAll($data){
        //load our new PHPExcel library
        $this->load->library('excel');
        $filename = $data['filename'];

        $count = 1;
        $character = 'A';
        foreach($data['headers'] as $head){
            $this->excel->setActiveSheetIndex(0)->setCellValue("$character$count", $head);
            $character++;
        }

        $count = 2;
        foreach($data['data'] as  $row){
            $character = 'A';
            foreach($row as $key => $column){
                $this->excel->setActiveSheetIndex(0)->setCellValue("$character$count", $column);
                $character++;
            }
            $count++;
        }
        /* Download in CSV format Close */
        // Rename worksheet
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->setActiveSheetIndex(0);

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


}