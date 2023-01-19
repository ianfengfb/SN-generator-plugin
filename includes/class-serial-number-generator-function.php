<?php
/*
 * Add my new menu to the Admin Control Panel
 */
// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'serial_number_menu' );
// Add a new top level menu link to the ACP
function serial_number_menu()
{
      add_menu_page(
        'Serial Number', // Title of the page
        'Srial Number', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'serial_number', // The 'slug' - file to display when clicking the link
        'init_serial_number'//Function
    );
}

function init_serial_number() {

  $initor = new Serial_Number_Page;

  $initor -> init_serial_number();
}

/**
 * Create a user when order is completed.
 * 
 * @param int $order_id Order ID. 
 */
// function sa_create_user( $order_id ) {

//   $password    = wp_generate_password( 16, true );
//   $user_name   = $user_email = 'testuser@gmail.com';

//   $customer_id = wc_create_new_customer( $user_email, $user_name, $password );
// }

/**
     * Add new note item to the database
     * @param () $user_id, $title, $content, $category = NULL, $type = NULL, $shared_by = NULL, $editable = 1
     * @return (int|false) The number of rows inserted, or false on error
     */     
    function add_order_number_to_database()
    {
        global $wpdb, $db_serial_number;

        $serial_numer = generate_serial_number();
        $current_id = get_current_user_id();

        $new_item_data = array(
            'user_id' => $current_id,
            'serial_number' => $serial_numer,
            'order_id' => 1,
            'activated' => 0
        );
        // print_r($new_item_data);

        $result = $wpdb->insert($db_serial_number, $new_item_data);
        echo $serial_numer;
    }

add_action( 'woocommerce_order_status_completed', 'add_order_number_to_database', 20, 2 );

// generate serial number
function generate_serial_number() {
  $arr = array();
for($i = 0; $i < 20; $i++){
      if($letter_OR_number = rand(0,1)){ // true: alphabet chosen
         $arr[] = chr(rand(65, 90));
      } else { // false: number chosen
         $arr[] = rand(0,9);
      }
      if($i % 4 == 3){
        ($i < 19)? $arr[] = '-': $arr[] = ' ';
      }
}

$str = implode('', $arr);
return $str;
}

// add_action('woocommerce_after_single_product_summary', 'add_order_number_to_database');


// enqueue and localise scripts
wp_enqueue_script( 'serial_number_generator_function', plugin_dir_url( __FILE__ ) . 'js/serial-number-generator-admin.js', array( 'jquery' ) );
wp_localize_script( 'serial_number_generator_function', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

add_action( 'wp_ajax_sn_check_sn_exist', 'check_if_sn_exit' );
add_action( 'wp_ajax_nopriv_sn_check_sn_exist', 'check_if_sn_exit' );

function check_if_sn_exit() {
  ob_clean();
		
  $sn_tobe_check = $_POST['sn_tobe_check'];
  $sn_ctr = new Serial_Number_Ctr;
  $result = $sn_ctr->check_sn_exist($sn_tobe_check);
  print_r($result);
		wp_die();
}

// 1. Register new endpoint
// Note: Resave Permalinks or it will give 404 error  
function QuadLayers_add_support_endpoint() {
  add_rewrite_endpoint( 'support', EP_ROOT | EP_PAGES );
}  
add_action( 'init', 'QuadLayers_add_support_endpoint' );  
// ------------------
// 2. Add new query
function QuadLayers_support_query_vars( $vars ) {
  $vars[] = 'support';
  return $vars;
}  
add_filter( 'query_vars', 'QuadLayers_support_query_vars', 0 );  
// ------------------
// 3. Insert the new endpoint 
function QuadLayers_add_support_link_my_account( $items ) {
  $items['support'] = 'Serial Number ™';
  return $items;
}  
add_filter( 'woocommerce_account_menu_items', 'QuadLayers_add_support_link_my_account' );
// ------------------
// 4. Add content to the new endpoint  
function QuadLayers_support_content() {
  $current_id = get_current_user_id();
  $sn_ctr = new Serial_Number_Ctr;
  $result = $sn_ctr->check_sn_activae_by_user($current_id);
  $result_activate = $result[0]['activated'];
  $result_time = $result[0]['activated_time'];
  $modify_result = date("d/m/y g:i A", strtotime($result_time . '+ 1 year'));
  if ($result_activate) {
    echo '<div id="serial_id_activated_time">Your warranty has been activated, and it will be expired on: ' . $modify_result . '</div>';
  } else {
  echo '<h3>Enter Your Serial Number</h3>';
  echo '<div class="form_contianer" id="serial_id_validator_form_container"><form action="" id="serial_id_validator_form"><input type="text" id="serial_id_validator_sn" name="serial_name_validator_sn" placeholder="****-****-****-****" required><button id="serial_id_validator_btn">Submit</button></div></form>';
  }
  echo '<div id="serial_id_validator_message"></div>';
}  
add_action( 'woocommerce_account_support_endpoint', 'QuadLayers_support_content' );