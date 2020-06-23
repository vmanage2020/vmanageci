<?php
/**
 * Created by PhpStorm.
 * User: Binary Tech Resonance Pvt. Ltd.
 * Date: 15-04-2019
 * Time: 12:07 PM
 */

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	function signIn($data) {
		$q = $this->db->get_where('gn_ms_users', $data, 1);
		if($q->num_rows() > 0) {
			$result = $q->row();

			if((int) $result->status === 0) {
				$this->session->set_flashdata('error', 'Your Account is temporarily locked. Please contact Administrator for further details.');
				return false;
			}

			return $result;
		}
		$this->session->set_flashdata('error', 'Username/Password Incorrect. Please recheck and try again.');
		return false;
	}

	/*

	function checkUserByPassword($password) {
		$this->db->where('admin_pwd', $password);
		$q = $this->db->get('admin');
		if($q->num_rows() > 0) {
			return true;
		}
		return false;
	}

	function addAdminUser($data) {
		if($this->db->insert('admin', $data)){
			return true;
		}
		return false;
	}

	function getAdminUserByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('admin');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function updateAdminUser($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('admin', $data)) {
			return true;
		}
		return false;
	}

	function deleteAdminUser($id) {
		if($this->db->delete('admin', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function changePassword($id,$data) {
		$this->db->where('id', 1);
		if($this->db->update('admin', $data)) {
			return true;
		}
		return false;
	}

	function getSiteSetting($id = 1) {
		$this->db->where('id', $id);

		$q = $this->db->get('setting');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function updateSetting($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('setting', $data)) {
			return true;
		}
		return false;
	}

	function getAllTestimonials() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('testimonial');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllFeatures() {
		$this->db->select('features.id, features.title, features.icon_name, features.short_desc, invest_icon.title as icon_title');
		$this->db->order_by('id', 'desc');
		$this->db->join('invest_icon','invest_icon.icon_name=features.icon_name');
		$q = $this->db->get('features');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllHeadFeatures() {
		$this->db->select('head_features.id, 
							head_features.title, 
							head_features.icon_name, 
							head_features.short_desc, 
							invest_icon.title as icon_title');
		$this->db->join('invest_icon','invest_icon.icon_name=head_features.icon_name');
		$this->db->order_by('head_features.id', 'asc');
		$q = $this->db->get('head_features');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllFAQs() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('faq_table');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllSliders() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('banner');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllRiskProfile() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('risk_profile');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllInvestors() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('investor');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllInvestorCategories() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('inv_category');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllRiskAllocations() {
		$this->db->select('inv_show.id as id, 
							inv_show.main_cat, 
							inv_show.sub_cat, 
							inv_show.inv_per, 
							inv_category.title,
							investor.inv_type');
		$this->db->join('inv_category', 'inv_category.id=inv_show.sub_cat');
		$this->db->join('investor', 'investor.id=inv_show.main_cat');
		$this->db->order_by('inv_show.id', 'desc');

		$q = $this->db->get('inv_show');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

    function getAllMeterFunds() {
        $this->db->select('fund_meter.id as id, 
							fund_meter.categ_id, 
							fund_meter.title, 
							fund_meter.rank, 
							mutual_category.title as category_title');
        $this->db->join('mutual_category', 'mutual_category.id=fund_meter.categ_id');

        $this->db->order_by('fund_meter.id', 'desc');

        $q = $this->db->get('fund_meter');
        if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

	function getAllFundCategories() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('fund_category');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

    function getAllSeoPages() {
        $this->db->order_by('id', 'desc');
        $q = $this->db->get('seo');
        if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

	function getAllMFConsistent() {
		$this->db->select('fund_category.title as category_title, 
							mf_fund.id as id, 
							mf_fund.title as fund_title, 
							mf_fund.incep_date, 
							mf_fund.fund_size, 
							mf_fund.first_yr, 
							mf_fund.three_yr, 
							mf_fund.five_yr, 
							mf_fund.seven_yr, 
							mf_fund.ten_yr');
		$this->db->join('fund_category', 'fund_category.id=mf_fund.cat_id');
		$this->db->order_by('mf_fund.id', 'desc');

		$q = $this->db->get('mf_fund');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllMutualFundSynopsis() {
		$this->db->order_by('id', 'desc');
		$q = $this->db->get('mf_synopsis');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllResearchSummary($type = NULL) {
		if(!is_null($type)) {
			$this->db->where('res_type', $type);
		}
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('research_summary');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllBSESensex() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('bse_sensex');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllNSESensex() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('nse_sensex');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllGlobalIndices() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('global_indices');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllAdminUsers() {
		$this->db->where('role != ', '1');
		$this->db->order_by('first_name', 'asc');
		$q = $this->db->get('admin');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllBlogPosts() {
		$this->db->order_by('blog_id', 'desc');

		$q = $this->db->get('blog');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllBlogCategories($order_by = 'category_title', $order = 'asc') {
		$this->db->order_by($order_by, $order);

		$q = $this->db->get('blog_categories');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function addCMSPage($data = array()) {
		if($this->db->insert('cms_pages', $data)) {
			return true;
		}
		return false;
	}

	function addTestimonial($data = array()) {
        $this->updateTestimonialsOrder($data['testimonial_order']);

		if($this->db->insert('testimonial', $data)) {
			return true;
		}
		return false;
	}

	function addFeature($data = array()) {
		if($this->db->insert('features', $data)) {
			return true;
		}
		return false;
	}

	function addHeadFeature($data = array()) {
		if($this->db->insert('head_features', $data)) {
			return true;
		}
		return false;
	}

	function addFAQ($data = array()) {
		if($this->db->insert('faq_table', $data)) {
			return true;
		}
		return false;
	}

	function addSlider($data = array()) {
		if($this->db->insert('banner', $data)) {
			return true;
		}
		return false;
	}

	function addRiskProfile($data = array()) {
		if($this->db->insert('risk_profile', $data)) {
			return true;
		}
		return false;
	}

	function addInvestor($data = array()) {
		if($this->db->insert('investor', $data)) {
			return true;
		}
		return false;
	}

	function addRiskAllocation($data = array()) {
		if($this->db->insert('inv_show', $data)) {
			return true;
		}
		return false;
	}

    function addMeterFund($data = array()) {
        if($this->db->insert('fund_meter', $data)) {
            return true;
        }
        return false;
    }

    function addMeterFundCategory($data = array()) {
        if($this->db->insert('mutual_category', $data)) {
            return true;
        }
        return false;
    }

	function addFundCategory($data = array()) {
		if($this->db->insert('fund_category', $data)) {
			return true;
		}
		return false;
	}

	function addMFConsistent($data = array()) {
		if($this->db->insert('mf_fund', $data)) {
			return true;
		}
		return false;
	}

	function addBulkMFConsistent($data = array()) {
		if($this->db->insert_batch('mf_fund', $data)) {
			return true;
		}
		return false;
	}

	function addMutualFundSynopsis($data = array()) {
		if($this->db->insert('mf_synopsis', $data)) {
			return true;
		}
		return false;
	}

	function addBulkMutualFundSynopsis($data = array()) {
		if($this->db->insert_batch('mf_synopsis', $data)) {
			return true;
		}
		return false;
	}

	function addResearchSummary($data = array()) {
		if($this->db->insert('research_summary', $data)) {
			return true;
		}
		return false;
	}

	function addBseSensex($data = array()) {
		if($this->db->insert('bse_sensex', $data)) {
			return true;
		}
		return false;
	}

	function addNseSensex($data = array()) {
		if($this->db->insert('nse_sensex', $data)) {
			return true;
		}
		return false;
	}

	function addGlobalIndices($data = array()) {
		if($this->db->insert('global_indices', $data)) {
			return true;
		}
		return false;
	}

	function addBlogPost($data = array()) {
        $this->updateBlogPostsOrder($data['blog_order']);

		if($this->db->insert('blog', $data)) {
			return true;
		}
		return false;
	}

	function addBlogCategory($data = array()) {
		if($this->db->insert('blog_categories', $data)) {
			return true;
		}
		return false;
	}

	function checkTodayBSESensex($check_date) {
		$this->db->where('check_date', $check_date);
		$q = $this->db->get('bse_sensex');
		if($q->num_rows() > 0) {
			return true;
		}
		return false;
	}

	function checkTodayNSESensex($check_date) {
		$this->db->where('check_date', $check_date);
		$q = $this->db->get('nse_sensex');
		if($q->num_rows() > 0) {
			return true;
		}
		return false;
	}

	function checkTodayGlobalIndices($check_date) {
		$this->db->where('check_date', $check_date);
		$q = $this->db->get('global_indices');
		if($q->num_rows() > 0) {
			return true;
		}
		return false;
	}

	function updateBlogPostsOrder($order, $operator = '+') {
        $this->db->where('blog_order >= ', $order);
        $this->db->set('blog_order', 'blog_order'.$operator.'1', FALSE);

        $this->db->order_by('blog_order', 'asc');
        if($this->db->update('blog')) {
            return true;
        }
        return false;
    }

    function updateTestimonialsOrder($order, $operator = '+') {
        $this->db->where('testimonial_order >= ', $order);
        $this->db->set('testimonial_order', 'testimonial_order'.$operator.'1', FALSE);

        $this->db->order_by('testimonial_order', 'asc');
        if($this->db->update('testimonial')) {
            return true;
        }
        return false;
    }

	function updateCMSPage($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('cms_pages', $data)) {
			return true;
		}
		return false;
	}

	function updateTestimonial($id, $data = array()) {
	    if($this->findDuplicateTestimonialOrder($id, $data['testimonial_order'])) {
	        $this->updateTestimonialsOrder($data['testimonial_order']);
        }

		$this->db->where('id', $id);
		if($this->db->update('testimonial', $data)) {
			return true;
		}
		return false;
	}

	function updateFeature($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('features', $data)) {
			return true;
		}
		return false;
	}

	function updateHeadFeature($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('head_features', $data)) {
			return true;
		}
		return false;
	}

	function updateFAQ($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('faq_table', $data)) {
			return true;
		}
		return false;
	}

	function updateSlider($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('banner', $data)) {
			return true;
		}
		return false;
	}

	function updateRiskProfile($id, $data = array()) {
		$this->db->where('id', $id);

		if($this->db->update('risk_profile', $data)) {
			return true;
		}
		return false;
	}

	function updateInvestor($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('investor', $data)) {
			return true;
		}
		return false;
	}

	function updateRiskAllocation($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('inv_show', $data)) {
			return true;
		}
		return false;
	}

	function updateMeterFund($id, $data = array()) {
        $this->db->where('id', $id);
		if($this->db->update('fund_meter', $data)) {
			return true;
		}
        return false;
	}

    function updateMeterFundCategory($id, $data = array()) {
        $this->db->where('id', $id);
        if($this->db->update('mutual_category', $data)) {
            return true;
        }
        return false;
    }

    function updateSEO($id, $data = array()) {
        $this->db->where('id', $id);
        if($this->db->update('seo', $data)) {
            return true;
        }
        return false;
    }

	function updateFundCategory($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('fund_category', $data)) {
			return true;
		}
		return false;
	}

	function updateMFConsistent($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('mf_fund', $data)) {
			return true;
		}
		return false;
	}

	function updateMutualFundSynopsis($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('mf_synopsis', $data)) {
			return true;
		}
		return false;
	}

	function updateResearchSummary($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('research_summary', $data)) {
			return true;
		}
		return false;
	}

	function updateBseSensex($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('bse_sensex', $data)) {
			return true;
		}
		return false;
	}

	function updateNseSensex($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('nse_sensex', $data)) {
			return true;
		}
		return false;
	}

	function updateGlobalIndices($id, $data = array()) {
		$this->db->where('id', $id);
		if($this->db->update('global_indices', $data)) {
			return true;
		}
		return false;
	}

	function findDuplicatePostOrder($id, $order) {
        $this->db->where('blog_id != ', $id);
        $this->db->where('blog_order', $order);

        $q = $this->db->get('blog');
        if($q->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function findDuplicateTestimonialOrder($id, $order) {
        $this->db->where('id != ', $id);
        $this->db->where('testimonial_order', $order);

        $q = $this->db->get('testimonial');
        if($q->num_rows() > 0) {
            return true;
        }
        return false;
    }

	function updateBlogPost($id, $data = array()) {
	    if($this->findDuplicatePostOrder($id, $data['blog_order'])) {
            $this->updateBlogPostsOrder($data['blog_order']);
        }

		$this->db->where('blog_id', $id);
		if($this->db->update('blog', $data)) {
			return true;
		}
		return false;
	}

	function updateBlogCategory($id, $data = array()) {
		$this->db->where('category_id', $id);
		if($this->db->update('blog_categories', $data)) {
			return true;
		}
		return false;
	}

	function updateCMSPageStat($id, $status) {
		$this->db->where('id', $id);

		if($this->db->update('cms_pages', array('status' => $status))) {
			return true;
		}
		return false;
	}

	function updateTestimonialStat($id, $status) {
		$this->db->where('id', $id);

		if($this->db->update('testimonial', array('status' => $status))) {
			return true;
		}
		return false;
	}

	function updateSliderStat($id, $status) {
		if($status == 1) {
			$this->updateSlidersStatus();
		}

		$this->db->where('id', $id);
		if($this->db->update('banner', array('status' => $status))) {
			return true;
		}
		return false;
	}

	function updateSlidersStatus($status = 0) {
		if($this->db->update('banner', array('status' => $status))){
			return true;
		}
		return false;
	}

	function deleteCMS($id) {
		if($this->db->delete('cms_pages', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteTestimonial($id) {
	    $testimonial = $this->getTestimonialByID($id);
		if($this->db->delete('testimonial', array('id' => $id))) {
            $this->updateBlogPostsOrder($testimonial->testimonial_order, '-');
			return true;
		}
		return false;
	}

	function deleteFeature($id) {
		if($this->db->delete('features', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteHeadFeature($id) {
		if($this->db->delete('head_features', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteFAQ($id) {
		if($this->db->delete('faq_table', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteSlider($id) {
		if($this->db->delete('banner', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteRiskProfile($id) {
		if($this->db->delete('risk_profile', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteInvestor($id) {
		if($this->db->delete('investor', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteRiskAllocation($id) {
		if($this->db->delete('inv_show', array('id' => $id))) {
			return true;
		}
		return false;
	}

    function deleteMeterFund($id) {
        if($this->db->delete('fund_meter', array('id' => $id))) {
            return true;
        }
        return false;
    }

    function deleteMeterFundCategory($id) {
        if($this->db->delete('mutual_category', array('id' => $id))) {
            return true;
        }
        return false;
    }

	function deleteFundCategory($id) {
		if($this->db->delete('fund_category', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteMFConsistent($id) {
		if($this->db->delete('mf_fund', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteMutualFundSynopsis($id) {
		if($this->db->delete('mf_synopsis', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteResearchSummary($id) {
		if($this->db->delete('research_summary', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteBseSensex($id) {
		if($this->db->delete('bse_sensex', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteNseSensex($id) {
		if($this->db->delete('nse_sensex', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteGlobalIndices($id) {
		if($this->db->delete('global_indices', array('id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteBlogPost($id) {
	    $post = $this->getBlogPostByID($id);
		if($this->db->delete('blog', array('blog_id' => $id))) {
            $this->updateBlogPostsOrder($post->blog_order, '-');
			return true;
		}
		return false;
	}

	function deleteBlogCategory($id) {
		if($this->db->delete('blog_categories', array('category_id' => $id))) {
			return true;
		}
		return false;
	}

	function deleteRiskProfileEnquiry($id) {
		$this->db->where('id', $id);
		if($this->db->delete('risk_profile_enquiries') && $this->removeRiskAnswersByEID($id)) {
			return true;
		}
		return false;
	}

	function deleteUploadsEnquiry($id) {
		$this->db->where('id', $id);
		if($this->db->delete('upload_documents')
		   && $this->removeUploadMFByUID($id)
		   && $this->removeUploadDEByUID($id)
		   && $this->removeUploadInsByUID($id)) {
			return true;
		}
		return false;
	}

	function removeUploadMFByUID($id) {
		$this->db->where('uploader_id', $id);
		if($this->db->delete('upload_mutual_funds')) {
			return true;
		}
		return false;
	}

	function removeUploadDEByUID($id) {
		$this->db->where('uploader_id', $id);
		if($this->db->delete('upload_direct_equity')) {
			return true;
		}
		return false;
	}

	function removeUploadInsByUID($id) {
		$this->db->where('uploader_id', $id);
		if($this->db->delete('upload_insurance')) {
			return true;
		}
		return false;
	}

	function removeRiskAnswersByEID($eid) {
		$this->db->where('enquiry_id', $eid);
		if($this->db->delete('risk_profile_enquiries_qa')){
			return true;
		}
		return false;
	}

	function deleteLead($id) {
		$this->db->where('id', $id);
		if($this->db->delete('users')){
			return true;
		}
		return false;
	}

	function getAllInvestIcons() {
		$this->db->order_by('id', 'asc');

		$q = $this->db->get('invest_icon');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllCMSPages() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('cms_pages');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getCMSPage($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('cms_pages');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getTestimonialByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('testimonial');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getFeatureByID($id) {
		$this->db->select('features.id, 
							features.title, 
							features.icon_name, 
							features.short_desc, 
							features.long_desc, 
							invest_icon.title as icon_title');
		$this->db->join('invest_icon', 'invest_icon.icon_name=features.icon_name');
		$this->db->where('features.id', $id);
		$q = $this->db->get('features');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getHeadFeatureByID($id) {
		$this->db->select('head_features.id, 
							head_features.title, 
							head_features.icon_name, 
							head_features.short_desc,							
							invest_icon.title as icon_title');
		$this->db->join('invest_icon', 'invest_icon.icon_name=head_features.icon_name');
		$this->db->where('head_features.id', $id);
		$q = $this->db->get('head_features');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getFAQByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('faq_table');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getSliderByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('banner');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getRiskProfileByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('risk_profile');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getRiskProfileAnswersByEID($eid) {
		$this->db->where('enquiry_id', $eid);
		$q = $this->db->get('risk_profile_enquiries_qa');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getInvestorByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('investor');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getRiskAllocationByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('inv_show');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

    function getMeterFundByID($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('fund_meter');
        if($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    function getSEOByID($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('seo');
        if($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    function getMeterFundCategoryByID($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('mutual_category');
        if($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

	function getFundCategoryByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('fund_category');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getMFConsistentByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('mf_fund');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getMutualFundSynopsisByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('mf_synopsis');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getResearchSummaryByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('research_summary');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getBseSensexByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('bse_sensex');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getNseSensexByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('nse_sensex');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getGlobalIndicesByID($id) {
		$this->db->where('id', $id);
		$q = $this->db->get('global_indices');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getBlogPostByID($id) {
		$this->db->where('blog_id', $id);
		$q = $this->db->get('blog');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getBlogCategoryByID($id) {
		$this->db->where('category_id', $id);
		$q = $this->db->get('blog_categories');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getLastBseSensex($limit = 1) {
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$q = $this->db->get('bse_sensex');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getLastNseSensex($limit = 1) {
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$q = $this->db->get('nse_sensex');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getLastGlobalIndice($limit = 1) {
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$q = $this->db->get('global_indices');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getAllMutualCategories() {
		$this->db->order_by('id', 'desc');

		$q = $this->db->get('mutual_category');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllRiskProfileEnquiries() {
		$this->db->order_by('dated', 'desc');

		$q = $this->db->get('risk_profile_enquiries');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllUploadEnquiries() {

		$this->db->select('
				upload_documents.id as id,		
				upload_documents.user_id,		
				upload_documents.user_name,		
				upload_documents.user_mobile,		
				upload_documents.user_dob,		
				upload_documents.user_email,		
				upload_documents.user_pan,		
				upload_documents.holding_nature,		
				upload_documents.occupation,		
				upload_documents.address_line_1,		
				upload_documents.address_line_2,		
				upload_documents.city,		
				upload_documents.state,		
				upload_documents.country,		
				upload_documents.pin_code,		
				upload_documents.tax_status,		
				upload_documents.nominee_name,		
				upload_documents.nominee_relationship,		
				upload_documents.nominee_dob,		
				upload_documents.bank_ac_name,		
				upload_documents.bank_ac_no,		
				upload_documents.bank_branch,		
				upload_documents.bank_ac_type,		
				upload_documents.bank_ifsc,		
				upload_documents.bank_micr,		
				upload_documents.second_applicant_name,		
				upload_documents.second_applicant_dob,		
				upload_documents.second_applicant_pan,		
				upload_documents.guardian_name,		
				upload_documents.guardian_relationship,		
				upload_documents.guardian_dob,		
				upload_documents.guardian_pan,		
				upload_documents.signature_text,		
				upload_documents.signature_image,		
				upload_documents.added_date,		
				upload_documents.updated_date,
						
				upload_mutual_funds.account_opening_form as mf_account_opening_form,		
				upload_mutual_funds.signed_bank_mandate as mf_signed_bank_mandate,		
				upload_mutual_funds.signed_common_transaction_form as mf_signed_common_transaction_form,		
				upload_mutual_funds.signed_kyc_form as mf_signed_kyc_form,		
				upload_mutual_funds.self_attested_aadhar as mf_self_attested_aadhar,		
				upload_mutual_funds.self_attested_pan as mf_self_attested_pan,		
				upload_mutual_funds.passport_size_photo as mf_passport_size_photo,		
				upload_mutual_funds.signature as mf_signature,
						
				upload_direct_equity.account_opening_form as de_account_opening_form,		
				upload_direct_equity.disclaimer_form as de_disclaimer_form,		
				upload_direct_equity.power_of_attorney as de_power_of_attorney,		
				upload_direct_equity.demat_form as de_demat_form,		
				upload_direct_equity.fatca_declaration as de_fatca_declaration,		
				upload_direct_equity.nominee_details_form as de_nominee_details_form,
				upload_direct_equity.signed_kyc_form as de_signed_kyc_form,		
				upload_direct_equity.self_attested_aadhar as de_self_attested_aadhar,		
				upload_direct_equity.self_attested_pan as de_self_attested_pan,		
				upload_direct_equity.passport_size_photo as de_passport_size_photo,		
				upload_direct_equity.signature as de_signature,
				
				upload_insurance.account_opening_form as i_account_opening_form,		
				upload_insurance.health_assessment_form as i_health_assessment_form,		
				upload_insurance.tc_declaration as i_tc_declaration,
				upload_insurance.self_attested_aadhar as i_self_attested_aadhar,
				upload_insurance.self_attested_pan as i_self_attested_pan,
				upload_insurance.passport_size_photo as i_passport_size_photo,
				upload_insurance.signature as i_signature');

		$this->db->join('upload_mutual_funds','upload_mutual_funds.uploader_id=upload_documents.id', 'left');
		$this->db->join('upload_direct_equity','upload_direct_equity.uploader_id=upload_documents.id', 'left');
		$this->db->join('upload_insurance','upload_insurance.uploader_id=upload_documents.id', 'left');

		$this->db->order_by('added_date', 'desc');

		$q = $this->db->get('upload_documents');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}

	function getAllLeads($uid = NULL) {
		$this->db->select('users.id, users.first_name, user_mobile, user_email, user_city, lead_status, status_title, priority_title, source_title, CONCAT(admin.first_name, " ", admin.last_name) as assigned_to');
		$this->db->join('admin', 'admin.id=users.lead_assign_to', 'left');
		$this->db->join('lead_priorities', 'lead_priorities.priority_id=users.lead_priority', 'left');
		$this->db->join('lead_status', 'lead_status.status_id=users.lead_status', 'left');
		$this->db->join('lead_sources', 'lead_sources.source_id=users.lead_source', 'left');
		if(!is_null($uid)) {
			$this->db->where('users.lead_assign_to', $uid);
			$this->db->or_where('users.admin_id', $uid);
		}
		$this->db->order_by('id', 'desc');
		$q = $this->db->get('users');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllCountries() {
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('countries');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllPriorities() {
		$this->db->order_by('priority_title', 'asc');
		$q = $this->db->get('lead_priorities');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllSources() {
		$this->db->order_by('source_title', 'asc');
		$q = $this->db->get('lead_sources');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getAllStatus() {
		$this->db->order_by('status_title', 'asc');
		$q = $this->db->get('lead_status');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getArchiveYears($type = 'market_summary', $limit = 24) {
		$this->db->where('res_type', $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);

		$q = $this->db->get('research_summary');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getLastResearchSummary($type = NULL) {
		if(!is_null($type)) {
			$this->db->where('res_type', $type);
		}
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$q = $this->db->get('research_summary');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getNSESensex($limit = 1, $offset = 0) {
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $offset);
		$q = $this->db->get('nse_sensex');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getFAQbyCategoryID($catgory = NULL) {
		if(!is_null($catgory)) {
			$this->db->where('faq_cat', $catgory);
		}

		$this->db->order_by('id', 'asc');
		$q = $this->db->get('faq_table');

		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getMeterFundsByCategoryID($category_id) {
		if($category_id !== 'all') {
			$this->db->where('categ_id', $category_id);
		}
		$this->db->order_by('title', 'asc');
		$q = $this->db->get('fund_meter');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getMeterFundsJoined($category_id = NULL, $key = NULL) {
		$this->db->select('fund_meter.title as fund_title, fund_meter.categ_id as category_id, fund_meter.rank as rank, mutual_category.title as category_title');
		$this->db->join('mutual_category', 'mutual_category.id=fund_meter.categ_id');
		if(!is_null($key)) {
			$this->db->like('fund_meter.title', $key, 'both');
		}

		if($category_id !== 'all') {
			$this->db->where('fund_meter.categ_id', $category_id);
		}

		$this->db->order_by('fund_meter.title', 'asc');
		$q = $this->db->get('fund_meter');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function checkUserByMobile($mobile) {
		$this->db->where('user_mobile', $mobile);
		$this->db->from('users');
		return $this->db->count_all_results();
	}

	function checkUserByEmail($email) {
		$this->db->where('user_email', $email);
		$this->db->from('users');
		return $this->db->count_all_results();
	}

	function addOTP($mobile, $otp) {
		if($this->db->insert('check_otp', array('mobile' => $mobile, 'send_otp' => $otp))){
			return true;
		}
		return false;
	}

	function addLead($data) {
		if($this->db->insert('users', $data)){
			return true;
		}
		return false;
	}

	function updateOTP($id, $data) {
		$this->db->where('id', $id);
		if($this->db->update('check_otp', $data)){
			return true;
		}
		return false;
	}

	function updateLead($id, $data) {
		$this->db->where('id', $id);
		if($this->db->update('users', $data)){
			return true;
		}
		return false;
	}

	function getOTPbyMobile($mobile) {
		$this->db->where('mobile', $mobile);

		$q = $this->db->get('check_otp');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function checkOTP($otp, $mobile) {
		$this->db->where('mobile', $mobile);
		$this->db->where('send_otp', $otp);

		$q = $this->db->get('check_otp');
		if($q->num_rows() > 0) {
			return true;
		}
		return false;
	}

	function getCitiesByStateID($sid) {
		$this->db->select('cities.id as city_id, cities.name as city_name, states.id as state_id, states.name as state_name, states.country_id');
		$this->db->join('states', 'states.id=cities.state_id');
		$this->db->where('state_id', $sid);
		$q = $this->db->get('cities');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function createUser($data) {
		if($this->db->insert('users', $data)){
			return true;
		}
		return false;
	}

	function getStateByID($id) {
		$this->db->where('id', $id);

		$q = $this->db->get('states');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getCityByID($id) {
		$this->db->where('id', $id);

		$q = $this->db->get('cities');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	function getLeadByID($id) {
		$this->db->where('id', $id);

		$q = $this->db->get('users');
		if($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}

	*/

}
