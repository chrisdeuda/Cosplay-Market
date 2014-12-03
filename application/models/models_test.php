<?php

class Models_Test extends CI_Model{



	public function get_user_profile( $table_name = "", $user_id = "") {
		$SQL = "SELECT * FROM `{$table_name}` WHERE `USER_ID` = '{$user_id}'";
		$data =  array();
		$query = $this->db->query( $SQL );
		if ( $query->num_rows() <= 0) {
			return $data;
		} else {
			$data = $query->row_array();
			return $data;
		}
	}
}

?>