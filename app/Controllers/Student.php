<?php namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\StudentContactModel;
use App\Models\StudentCertificateModel;
use CodeIgniter\Controller;

class Student extends Controller {
 

    public function index()
    {
        $data['function'] = "api_list_student";
        $model = new StudentModel();

        $data['users'] = $model->getRows();

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

    }
    
  
    public function view($id=null)
    {
        $data['function'] = "api_view_student";
        $model = new StudentModel();

        $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where);
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    public function create()
    {
        $data['function'] = "api_save_student";
		$model = new StudentModel();
		$contactModel = new StudentContactModel();

        $jsondata = json_decode(file_get_contents('php://input'), true);
		
		$data = array(
				"col_code_fk" => $jsondata["col_code_fk"],
				"stu_prf_stud_name" => $jsondata["stu_prf_stud_name"],
				"stu_stud_mname" => $jsondata["stu_stud_mname"],
				"stu_stud_lname" => $jsondata["stu_stud_lname"],
				"stu_prf_dob" => $jsondata["stu_prf_dob"],
				"stu_prf_sex" => $jsondata["stu_prf_sex"],
				"stu_prf_mar_status" => $jsondata["stu_prf_mar_status"],
				"stu_prf_roll_No" => $jsondata["stu_prf_roll_No"],
				"stu_prf_app_No" => $jsondata["stu_prf_app_No"],
				"stu_prf_app_name" => $jsondata["stu_prf_app_name"],
				"stu_prf_app_date" => $jsondata["stu_prf_app_date"],
				"stu_prf_quota" => $jsondata["stu_prf_quota"],
				"stu_prf_current_Year" => $jsondata["stu_prf_current_Year"],
				"stu_prf_current_batch" => $jsondata["stu_prf_current_batch"],
				"stu_prf_lab_batch" => $jsondata["stu_prf_lab_batch"],
				"stu_prf_current_Semester" => $jsondata["stu_prf_current_Semester"],
				"stu_prf_seat_type_fk" => $jsondata["stu_prf_seat_type_fk"],
				"stu_prf_reg_no" => $jsondata["stu_prf_reg_no"],
				"stu_prf_degree_code" => $jsondata["stu_prf_degree_code"],
				"stu_prf_branch_Code" => $jsondata["stu_prf_branch_Code"],
				"stu_prf_cardno" => $jsondata["stu_prf_cardno"],
				"stu_prf_lib_id" => $jsondata["stu_prf_lib_id"],
				"stu_prf_jmonth" => $jsondata["stu_prf_jmonth"],
				"stu_prf_jyear" => $jsondata["stu_prf_jyear"],
				"stu_prf_attempts" => $jsondata["stu_prf_attempts"],
				"stu_prf_rejoin_status" => $jsondata["stu_prf_rejoin_status"],
				"stu_prf_fathers_name" => $jsondata["stu_prf_fathers_name"],
				"stu_prf_mothers_name" => $jsondata["stu_prf_mothers_name"],
				"stu_prf_guardian_name" => $jsondata["stu_prf_guardian_name"],
				"stu_prf_fathers_qual" => $jsondata["stu_prf_fathers_qual"],
				"stu_prf_mothers_qual" => $jsondata["stu_prf_mothers_qual"],
				"stu_prf_fathers_occup" => $jsondata["stu_prf_fathers_occup"],
				"stu_prf_mothers_occup" => $jsondata["stu_prf_mothers_occup"],
				"stu_prf_fathers_anninc" => $jsondata["stu_prf_fathers_anninc"],
				"stu_prf_mothers_anninc" => $jsondata["stu_prf_mothers_anninc"],
				"stu_prf_plc_of_livng" => $jsondata["stu_prf_plc_of_livng"],
				"stu_prf_plc_of_birth" => $jsondata["stu_prf_plc_of_birth"],
				"stu_prf_parents_handicap" => $jsondata["stu_prf_parents_handicap"],
				"stu_prf_parents_old_stu" => $jsondata["stu_prf_parents_old_stu"],
				"stu_prf_co_curr" => $jsondata["stu_prf_co_curr"],
				"stu_prf_mem_of_serv_org" => $jsondata["stu_prf_mem_of_serv_org"],
				"stu_prf_family_size" => $jsondata["stu_prf_family_size"],
				"stu_prf_community_fk" => $jsondata["stu_prf_community_fk"],
				"stu_prf_caste_fk" => $jsondata["stu_prf_caste_fk"],
				"stu_prf_religion_fk" => $jsondata["stu_prf_religion_fk"],
				"stu_prf_mother_tongue_fk" => $jsondata["stu_prf_mother_tongue_fk"],
				"stu_prf_citizen_fk" => $jsondata["stu_prf_citizen_fk"],
				"stu_prf_medium_ins_fk" => $jsondata["stu_prf_medium_ins_fk"],
				"stu_prf_bldgrp_fk" => $jsondata["stu_prf_bldgrp_fk"],
				"stu_prf_visualhandy" => $jsondata["stu_prf_visualhandy"],
				"stu_prf_parent_email" => $jsondata["stu_prf_parent_email"],
				"stu_prf_mobile_no" => $jsondata["stu_prf_mobile_no"],
				"stu_prf_stu_email" => $jsondata["stu_prf_stu_email"],
				"stu_prf_remarks" => $jsondata["stu_prf_remarks"],
				"stu_adm_no" => $jsondata["stu_adm_no"],
				"stu_adm_date" => $jsondata["stu_adm_date"],
				"stu_adm_barcode" => $jsondata["stu_adm_barcode"],
				"stu_adm_referby" => $jsondata["stu_adm_referby"],
				"stu_adm_tcno" => $jsondata["stu_adm_tcno"],
				"stu_adm_entry_mode" => $jsondata["stu_adm_entry_mode"],
				"stu_adm_tcdate" => $jsondata["stu_adm_tcdate"],
				"stu_adm_sections" => $jsondata["stu_adm_sections"],
				"stu_adm_debar_reason" => $jsondata["stu_adm_debar_reason"],
				"stu_adm_prev_colname" => $jsondata["stu_adm_prev_colname"],
				"stu_adm_app_no" => $jsondata["stu_adm_app_no"],
				"stu_adm_app_dt" => $jsondata["stu_adm_app_dt"],
				"stu_adm_stu_image" => $jsondata["stu_adm_stu_image"],
				"stu_adm_mode" => $jsondata["stu_adm_mode"],
				"stu_adm_status" => $jsondata["stu_adm_status"],
				"stu_detained" => $jsondata["stu_detained"],
				"stu_discontinue" => $jsondata["stu_discontinue"],
				"stu_adm_fee" => $jsondata["stu_adm_fee"],
				"stu_adm_class" => $jsondata["stu_adm_class"],
				"stu_prf_promotion_status" => $jsondata["stu_prf_promotion_status"],
				"stu_group_id_fk" => $jsondata["stu_group_id_fk"],
				"stu_adm_std" => $jsondata["stu_adm_std"],
				"stu_prf_sec_lang" => $jsondata["stu_prf_sec_lang"],
				"stu_prf_third_lang" => $jsondata["stu_prf_third_lang"],
				"stu_adm_fee_coll" => $jsondata["stu_adm_fee_coll"],
				"stu_adm_refno" => $jsondata["stu_adm_refno"],
				"status" => 0,
				"create_date" => date('Y-m-d H:i:s'),
				"create_by" => 1,
				"edit_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0
		);
		
		//echo '<pre>data->';print_r($data);die;
        
		$insertedData = $model->saveStudent($data);
		//echo '<pre>$insertedData->';print_r($insertedData);
		$insertedID = $insertedData->connID->insert_id;
		if($insertedID>0)
		{

			$contactData = array(
				"col_code_fk" => trim($jsondata["col_code_fk"]),
				"stu_prf_code_fk" => $insertedID,
				"con_per_add" => trim($jsondata["con_per_add"]),
				"con_per_state" => trim($jsondata["con_per_state"]),
				"con_per_cntry" => trim($jsondata["con_per_cntry"]),
				"con_per_pincode" => trim($jsondata["con_per_pincode"]),
				"con_per_phone" => trim($jsondata["con_per_phone"]),
				"con_cont_add" => trim($jsondata["con_cont_add"]),
				"con_cont_state" => trim($jsondata["con_cont_state"]),
				"con_cont_cntry" => trim($jsondata["con_cont_cntry"]),				
				"con_cont_pincode" => trim($jsondata["con_cont_pincode"]),
				"con_cont_phone" => trim($jsondata["con_cont_phone"]),
				"con_experience" => trim($jsondata["con_experience"]),
				"con_interrupt" => trim($jsondata["con_interrupt"]),
				"con_identify_marks" => trim($jsondata["con_identify_marks"]),
				"con_rel_info" => trim($jsondata["con_rel_info"]),
				"con_mode" => trim($jsondata["con_mode"]),
				"con_rail_stn" => trim($jsondata["con_rail_stn"]),
				"status" => 0,
				"create_date" => date('Y-m-d H:i:s'),
				"create_by" => 1,
				"edit_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0
			);

			
			$insertedContactData = $contactModel->saveStudent($contactData);
			$insertedContactStudID = $insertedContactData->connID->insert_id;		
			
			if($insertedContactStudID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['message'] = "Inserted Success";
			}
			
		}
		else
		{
			$data['return']['message'] = "Error on Insert";
		}
		
		//echo '<pre>$insertedData->';print_r($insertedData);die;

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

        /*
        if (! $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ]))
        {
            echo view('templates/header', ['title' => 'Create a news item']);
            echo view('news/create');
            echo view('templates/footer');
        }
        else
        {
            $model->save([
                'title' => $this->request->getVar('title'),
                'slug'  => url_title($this->request->getVar('title'), '-', TRUE),
                'body'  => $this->request->getVar('body'),
            ]);

            echo view('news/success');
        }
        */
	}
	
	public function update($id)
    {

		$data['function'] = "api_save_student";
        $model = new StudentModel();
		$contactModel = new StudentContactModel();

        $jsondata = json_decode(file_get_contents('php://input'), true);
		
		$data = array(
				"col_code_fk" => $jsondata["col_code_fk"],
				"stu_prf_stud_name" => $jsondata["stu_prf_stud_name"],
				"stu_stud_mname" => $jsondata["stu_stud_mname"],
				"stu_stud_lname" => $jsondata["stu_stud_lname"],
				"stu_prf_dob" => $jsondata["stu_prf_dob"],
				"stu_prf_sex" => $jsondata["stu_prf_sex"],
				"stu_prf_mar_status" => $jsondata["stu_prf_mar_status"],
				"stu_prf_roll_No" => $jsondata["stu_prf_roll_No"],
				"stu_prf_app_No" => $jsondata["stu_prf_app_No"],
				"stu_prf_app_name" => $jsondata["stu_prf_app_name"],
				"stu_prf_app_date" => $jsondata["stu_prf_app_date"],
				"stu_prf_quota" => $jsondata["stu_prf_quota"],
				"stu_prf_current_Year" => $jsondata["stu_prf_current_Year"],
				"stu_prf_current_batch" => $jsondata["stu_prf_current_batch"],
				"stu_prf_lab_batch" => $jsondata["stu_prf_lab_batch"],
				"stu_prf_current_Semester" => $jsondata["stu_prf_current_Semester"],
				"stu_prf_seat_type_fk" => $jsondata["stu_prf_seat_type_fk"],
				"stu_prf_reg_no" => $jsondata["stu_prf_reg_no"],
				"stu_prf_degree_code" => $jsondata["stu_prf_degree_code"],
				"stu_prf_branch_Code" => $jsondata["stu_prf_branch_Code"],
				"stu_prf_cardno" => $jsondata["stu_prf_cardno"],
				"stu_prf_lib_id" => $jsondata["stu_prf_lib_id"],
				"stu_prf_jmonth" => $jsondata["stu_prf_jmonth"],
				"stu_prf_jyear" => $jsondata["stu_prf_jyear"],
				"stu_prf_attempts" => $jsondata["stu_prf_attempts"],
				"stu_prf_rejoin_status" => $jsondata["stu_prf_rejoin_status"],
				"stu_prf_fathers_name" => $jsondata["stu_prf_fathers_name"],
				"stu_prf_mothers_name" => $jsondata["stu_prf_mothers_name"],
				"stu_prf_guardian_name" => $jsondata["stu_prf_guardian_name"],
				"stu_prf_fathers_qual" => $jsondata["stu_prf_fathers_qual"],
				"stu_prf_mothers_qual" => $jsondata["stu_prf_mothers_qual"],
				"stu_prf_fathers_occup" => $jsondata["stu_prf_fathers_occup"],
				"stu_prf_mothers_occup" => $jsondata["stu_prf_mothers_occup"],
				"stu_prf_fathers_anninc" => $jsondata["stu_prf_fathers_anninc"],
				"stu_prf_mothers_anninc" => $jsondata["stu_prf_mothers_anninc"],
				"stu_prf_plc_of_livng" => $jsondata["stu_prf_plc_of_livng"],
				"stu_prf_plc_of_birth" => $jsondata["stu_prf_plc_of_birth"],
				"stu_prf_parents_handicap" => $jsondata["stu_prf_parents_handicap"],
				"stu_prf_parents_old_stu" => $jsondata["stu_prf_parents_old_stu"],
				"stu_prf_co_curr" => $jsondata["stu_prf_co_curr"],
				"stu_prf_mem_of_serv_org" => $jsondata["stu_prf_mem_of_serv_org"],
				"stu_prf_family_size" => $jsondata["stu_prf_family_size"],
				"stu_prf_community_fk" => $jsondata["stu_prf_community_fk"],
				"stu_prf_caste_fk" => $jsondata["stu_prf_caste_fk"],
				"stu_prf_religion_fk" => $jsondata["stu_prf_religion_fk"],
				"stu_prf_mother_tongue_fk" => $jsondata["stu_prf_mother_tongue_fk"],
				"stu_prf_citizen_fk" => $jsondata["stu_prf_citizen_fk"],
				"stu_prf_medium_ins_fk" => $jsondata["stu_prf_medium_ins_fk"],
				"stu_prf_bldgrp_fk" => $jsondata["stu_prf_bldgrp_fk"],
				"stu_prf_visualhandy" => $jsondata["stu_prf_visualhandy"],
				"stu_prf_parent_email" => $jsondata["stu_prf_parent_email"],
				"stu_prf_mobile_no" => $jsondata["stu_prf_mobile_no"],
				"stu_prf_stu_email" => $jsondata["stu_prf_stu_email"],
				"stu_prf_remarks" => $jsondata["stu_prf_remarks"],
				"stu_adm_no" => $jsondata["stu_adm_no"],
				"stu_adm_date" => $jsondata["stu_adm_date"],
				"stu_adm_barcode" => $jsondata["stu_adm_barcode"],
				"stu_adm_referby" => $jsondata["stu_adm_referby"],
				"stu_adm_tcno" => $jsondata["stu_adm_tcno"],
				"stu_adm_entry_mode" => $jsondata["stu_adm_entry_mode"],
				"stu_adm_tcdate" => $jsondata["stu_adm_tcdate"],
				"stu_adm_sections" => $jsondata["stu_adm_sections"],
				"stu_adm_debar_reason" => $jsondata["stu_adm_debar_reason"],
				"stu_adm_prev_colname" => $jsondata["stu_adm_prev_colname"],
				"stu_adm_app_no" => $jsondata["stu_adm_app_no"],
				"stu_adm_app_dt" => $jsondata["stu_adm_app_dt"],
				"stu_adm_stu_image" => $jsondata["stu_adm_stu_image"],
				"stu_adm_mode" => $jsondata["stu_adm_mode"],
				"stu_adm_status" => $jsondata["stu_adm_status"],
				"stu_detained" => $jsondata["stu_detained"],
				"stu_discontinue" => $jsondata["stu_discontinue"],
				"stu_adm_fee" => $jsondata["stu_adm_fee"],
				"stu_adm_class" => $jsondata["stu_adm_class"],
				"stu_prf_promotion_status" => $jsondata["stu_prf_promotion_status"],
				"stu_group_id_fk" => $jsondata["stu_group_id_fk"],
				"stu_adm_std" => $jsondata["stu_adm_std"],
				"stu_prf_sec_lang" => $jsondata["stu_prf_sec_lang"],
				"stu_prf_third_lang" => $jsondata["stu_prf_third_lang"],
				"stu_adm_fee_coll" => $jsondata["stu_adm_fee_coll"],
				"stu_adm_refno" => $jsondata["stu_adm_refno"],
				"edit_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0
		);
		
		//echo '<pre>data->';print_r($data);die;
        
		$updatedData = $model->updateStudent($data, $id);
		//echo '<pre>$$updatedData->';print_r($$updatedData);die;
		//$insertedID = $insertedData->connID->insert_id;
		if( $updatedData )
		{
			$lastInsertId = $id;

			$contactData = array(
				"col_code_fk" => trim($jsondata["col_code_fk"]),
				"stu_prf_code_fk" => $id,
				"con_per_add" => trim($jsondata["con_per_add"]),
				"con_per_state" => trim($jsondata["con_per_state"]),
				"con_per_cntry" => trim($jsondata["con_per_cntry"]),
				"con_per_pincode" => trim($jsondata["con_per_pincode"]),
				"con_per_phone" => trim($jsondata["con_per_phone"]),
				"con_cont_add" => trim($jsondata["con_cont_add"]),
				"con_cont_state" => trim($jsondata["con_cont_state"]),
				"con_cont_cntry" => trim($jsondata["con_cont_cntry"]),				
				"con_cont_pincode" => trim($jsondata["con_cont_pincode"]),
				"con_cont_phone" => trim($jsondata["con_cont_phone"]),
				"con_experience" => trim($jsondata["con_experience"]),
				"con_interrupt" => trim($jsondata["con_interrupt"]),
				"con_identify_marks" => trim($jsondata["con_identify_marks"]),
				"con_rel_info" => trim($jsondata["con_rel_info"]),
				"con_mode" => trim($jsondata["con_mode"]),
				"con_rail_stn" => trim($jsondata["con_rail_stn"]),
				"edit_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0
			);

			$updatedContactData =  $contactModel->updateStudent($contactData, $id);
			if( $updatedContactData )
			{
				//$data['return']['insertid'] = $id;
				$data['return']['message'] = "Updated Success";
			}
			
		}
		else
		{
			$data['return']['message'] = "Error on Insert";
		}
		
		//echo '<pre>$insertedData->';print_r($insertedData);die;

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($data, JSON_NUMERIC_CHECK);
		
	}
    

}