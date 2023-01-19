<?php

class Serial_Number_DB{

    function create_serial_numer_table(){
        global $wpdb, $db_serial_number;
 
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "
		CREATE TABLE IF NOT EXISTS `$db_serial_number` (
			`sn_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
			`user_id` int(50) NOT NULL,
			`serial_number` varchar(255),
			`activated_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			`order_id` int(50),
			`activated` tinyint(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (`sn_id`),
			KEY `sn_id` (`sn_id`)
			) $charset_collate AUTO_INCREMENT=1";
    
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}