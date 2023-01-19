<?php

class Serial_Number_Ctr {

    public function retrieve_sn_list(){
        global $wpdb, $db_serial_number;

        $sql = "SELECT * FROM $db_serial_number";

		$query_results = $wpdb->get_results( $wpdb->prepare($sql), ARRAY_A);

		return $query_results;
    }

    public function check_sn_exist($sn) {
        global $wpdb, $db_serial_number;

        $where = array( 'serial_number' => $sn );

        $data_to_update = array( 'activated' => true);

        // $sql = "SELECT * FROM $db_serial_number WHERE serial_number = %s";

        if( $wpdb->update( $db_serial_number, $data_to_update, $where) ) {
			return 1;
		}else {
			return 0;
		}
    }

    public function check_sn_activae_by_user($user_id) {
        global $wpdb, $db_serial_number;

        $sql = "SELECT * FROM $db_serial_number WHERE user_id = %d LIMIT 1";

        return $wpdb->get_results( $wpdb->prepare($sql, $user_id), ARRAY_A);
    }
}