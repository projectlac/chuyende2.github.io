<?php

include_once('lib/library.php');

include_once('lib/Pagination.php');



class action_registration extends library{



	public function formQandA(){

        global $conn_vn;

        

        // $optionsQ1_id = isset($_POST['optionsQ1_id']) ? $_POST['optionsQ1_id'] : '';
        // $optionsQ2_id = isset($_POST['optionsQ2_id']) ? $_POST['optionsQ2_id'] : '';
        // $optionsQ3_id = isset($_POST['optionsQ3_id']) ? $_POST['optionsQ3_id'] : '';
        // $optionsQ4_id = isset($_POST['optionsQ4_id']) ? $_POST['optionsQ4_id'] : '';
        // $optionsQ5_id = isset($_POST['optionsQ5_id']) ? $_POST['optionsQ5_id'] : '';
        // $optionsQ6_id = isset($_POST['optionsQ6_id']) ? $_POST['optionsQ6_id'] : '';
        // $optionsQ7_id = isset($_POST['optionsQ7_id']) ? $_POST['optionsQ7_id'] : '';
        // $optionsQ8_id = isset($_POST['optionsQ8_id']) ? $_POST['optionsQ8_id'] : '';
        // $optionsQ9_id = isset($_POST['optionsQ9_id']) ? $_POST['optionsQ9_id'] : '';        
        // $optionsQ10 = isset($_POST['optionsQ10']) ? $_POST['optionsQ10'] : '';
        // $sql = "INSERT into regInfor (regInfor_answer1, regInfor_answer2, regInfor_answer3, regInfor_answer4, regInfor_answer5, regInfor_answer6, regInfor_answer7, regInfor_answer8, regInfor_answer9) values ($optionsQ1_id, $optionsQ2_id, $optionsQ3_id, $optionsQ4_id, $optionsQ5_id, $optionsQ6_id, $optionsQ7_id, $optionsQ8_id, $optionsQ9_id)";

       

        $regInfor_id = isset($_POST['regInfor_id']) ? $_POST['regInfor_id'] : '';
        $regInfor_name = isset($_POST['regInfor_name']) ? $_POST['regInfor_name'] : '';
        $regInfor_wasBorn = isset($_POST['regInfor_wasBorn']) ? $_POST['regInfor_wasBorn'] : '';
        $regInfor_sex = isset($_POST['regInfor_sex']) ? $_POST['regInfor_sex'] : '';
        $regInfor_phone = isset($_POST['regInfor_phone']) ? $_POST['regInfor_phone'] : '';
        $regInfor_createdDate = $this->getDate();

        $sql = "INSERT into regInfor (regInfor_name, regInfor_wasBorn, regInfor_sex, regInfor_phone, regInfor_createdDate) values ('".$regInfor_name."','".$regInfor_wasBorn."','".$regInfor_sex."','".$regInfor_phone."','".$regInfor_createdDate."'"."  )";

        // $sql = "UPDATE regInfor set regInfor_name = '".$regInfor_name."', regInfor_wasBorn = '".$regInfor_wasBorn."', regInfor_sex = '".$regInfor_sex."', regInfor_phone = '".$regInfor_phone."', regInfor_createdDate = '".$regInfor_createdDate."' where regInfor_id = '".$regInfor_id."'";


        $result = mysqli_query($conn_vn,$sql);



        if($result == true){

            $id = $conn_vn->insert_id;

            echo json_encode(array('success'=>'Đăng ký lịch tư vấn trực tuyến thành công','id'=>$id,'url'=>'/'));                

        }else{

            // echo json_encode(array('error'=>'Lỗi, mời thử lại'));
            echo json_encode(array('error'=>$sql));

        }

    }



    public function formInfo(){



        global$conn_vn;

       

        $regInfor_id = isset($_POST['regInfor_id']) ? $_POST['regInfor_id'] : '';

        $regInfor_name = isset($_POST['regInfor_name']) ? $_POST['regInfor_name'] : '';

		$regInfor_wasBorn = isset($_POST['regInfor_wasBorn']) ? $_POST['regInfor_wasBorn'] : '';

		$regInfor_sex = isset($_POST['regInfor_sex']) ? $_POST['regInfor_sex'] : '';

		$regInfor_phone = isset($_POST['regInfor_phone']) ? $_POST['regInfor_phone'] : '';

		$regInfor_createdDate = $this->getDate();





        $sql = "UPDATE regInfor set regInfor_name = '".$regInfor_name."', regInfor_wasBorn = '".$regInfor_wasBorn."', regInfor_sex = '".$regInfor_sex."', regInfor_phone = '".$regInfor_phone."', regInfor_createdDate = '".$regInfor_createdDate."' where regInfor_id = '".$regInfor_id."'";

        // echo json_encode(array('success'=>$sql,'url'=>'/trac-nghiem-benh-tri#formThankYou')); 

        $result = mysqli_query($conn_vn,$sql);

        if($result == true){

            $id = $conn_vn->insert_id;

            // echo json_encode(array('success'=>$sql,'url'=>'/trac-nghiem-benh-tri#formThankYou'));                
            echo json_encode(array('success'=>$sql));                
        }else{

            echo json_encode(array('error'=>'Lỗi, mời thử lại'));

        }

        

    }


    public function formRegMember(){

        global $conn_vn;

        $regMember_id = isset($_POST['regMember_id']) ? $_POST['regMember_id'] : '';
        $regMember_mail = isset($_POST['regMember_mail']) ? $_POST['regMember_mail'] : '';
        
        $regMember_createdDate = $this->getDate();

        $sql = "INSERT into regMember (regMember_mail, regMember_createdDate) values ('".$regMember_mail."','".$regMember_createdDate."'".")";

        // $sql = "UPDATE regInfor set regInfor_name = '".$regInfor_name."', regInfor_wasBorn = '".$regInfor_wasBorn."', regInfor_sex = '".$regInfor_sex."', regInfor_phone = '".$regInfor_phone."', regInfor_createdDate = '".$regInfor_createdDate."' where regInfor_id = '".$regInfor_id."'";


        $result = mysqli_query($conn_vn,$sql);



        if($result == true){

            $id = $conn_vn->insert_id;

            echo json_encode(array('success'=>'Đăng ký lịch tư vấn trực tuyến thành công','id'=>$id,'url'=>'/'));                

        }else{

            // echo json_encode(array('error'=>'Lỗi, mời thử lại'));
            echo json_encode(array('error'=>$sql));

        }

    }

}



?>