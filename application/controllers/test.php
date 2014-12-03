<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function user() {
		$user_id = "2014-012940";
		$this->load->model("models_user");
		$query_data = $this->models_test->get_user_profile(TBL_USER_PROFILE, $user_id);
		$this->load->view("test", $query_data);
	}
}
?>