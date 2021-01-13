<?php

class Products extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductsModel');
    }

    public function index()
    {
        $data['products'] = $this->ProductsModel->getAllData('products');

        $this->load->view('products/index',$data);
    }

    public function addProducts()
    {
        if($this->input->server('REQUEST_METHOD')=='POST'){

            $name = $this->input->post('name');
            $company_name = $this->input->post('company_name');
            $category = $this->input->post('category');
            $skuno = $this->input->post('skuno');
            $batch_no = $this->input->post('batch_no');
            $qty = $this->input->post('qty');
            $size = $this->input->post('size');
            $price = $this->input->post('price');

            if(!empty($name) and !empty($company_name) and !empty($batch_no) and !empty($qty) and 
                !empty($price) and !empty($skuno) and !empty($price)){
               
                    if($this->ProductsModel->exists('products',array('batchno'=>$batch_no))){
                        $this->session->set_flashdata('error','Duplicate Batch No');
                        redirect($_SERVER['HTTP_REFERER']);
                    }

                    if($this->ProductsModel->exists('products',array('skuno'=>$skuno))){
                        $this->session->set_flashdata('error','Duplicate Skuno');
                        redirect($_SERVER['HTTP_REFERER']);
                    }

                    $data_arr = array(
                        'name' => $name,
                        'company_name' => $company_name,
                        'product_category' => $category,
                        'skuno' => $skuno,
                        'batchno' => $batch_no,
                        'size' => $size,
                        'quantity' => $qty,
                        'price' => $price
                    );
                
                // Upload File
                $file = $_FILES['file']['name'];

                if(!empty($file)){
                    $explode = explode('.',$file);
                    $ext = end($explode);
                    
                    $tmp_name = $_FILES['file']['tmp_name'];

                    if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){

                        if($_FILES['file']['size'] <= 2048){

                            $path = 'uploads/file/';
                            $file_name = time().'.'.$ext;

                            if(!is_dir($path)){
                                mkdir($path,0777,true);
                            }

                            if(move_uploaded_file($tmp_name,$path.$file_name)){
                                
                                $data_arr['image'] = $path.$file_name;

                            }else{
                                $this->session->set_flashdata('error','Oops not able to upload image, Please try again');
                                redirect($_SERVER['HTTP_REFERER']);
                            }

                        }else{
                            $this->session->set_flashdata('error','Invalid Image Size allowed size (2MB)');
                            redirect($_SERVER['HTTP_REFERER']);
                        }

                    }else{
                        $this->session->set_flashdata('error','Invalid Image Type allowed types (png,jpg,jpeg)');
                        redirect($_SERVER['HTTP_REFERER']);        
                    }
                }

                if($this->ProductsModel->saveData('products',$data_arr)){

                    $this->session->set_flashdata('success','Prducts '.$name.' added Successfully');
                    redirect('products');

                }else{
                    $this->session->set_flashdata('error','Something Went Wrong, Please Try Again');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                

            }else{
                $this->session->set_flashdata('error','Missing Required Paramerters');
                redirect($_SERVER['HTTP_REFERER']);
            }

        }else{

            $data['category'] = $this->ProductsModel->getData('products_category',array('status'=>1));
            $this->load->view('products/add_products',$data);
        }
    }


    public function viewProducts()
    {
        if($this->input->server('REQUEST_METHOD')=='POST'){

            $id = $this->input->post('id');

            if(!empty($id)){

                $product = $this->ProductsModel->getData('products',array('id'=>$id));

                if(!empty($product)){

                   $data['status'] = true;
                   $data['data'] = $product[0];
                    
                }else{
                    $data['status'] = false;
                    $data['message'] = 'Oops.. No Data Found!';
                }

            }else{
                $data['status'] = false;
                $data['message'] = 'Missing Requierd Parameters';
            }

        }else{
            $data['status'] = false;
            $data['message'] = 'Invalid Request Method';
        }

        echo json_encode($data);
        die();
    }

}

?>