
<?php
class Serial_Number_Page {
/**
 * Display a custom menu page
 */
public function init_serial_number(){

    $sn_ctr = new Serial_Number_Ctr;
    $sn_list = $sn_ctr->retrieve_sn_list();
    $serial = 0;
  ?>
	<div class="wrap page_container">
    <div class="header_container">
    <h1>Serial Number List</h1>
    </div>
    <div class="table_container">
    <div class="serial_container">
      <p>Serial</p> 
      <ul>
      <?php
        foreach ($sn_list as $sn) {
          $serial ++;
        ?>
        <li><?php echo $serial ?></li>
        <?php
        }
        ?>
      </ul>
    </div>
    <div class="serial_container">
    <p>Order Number</p> 
      <ul>
      <?php
        foreach ($sn_list as $sn) {
        ?>
        <li><?php echo $sn['order_id'] ?></li>
        <?php
        }
        ?>
      </ul>
    </div>
    <div class="serial_container">
    <p>Serial Number</p> 
      <ul>
        <?php
        foreach ($sn_list as $sn) {
        ?>
        <li><?php echo $sn['serial_number'] ?></li>
        <?php
        }
        ?>
      </ul>
    </div>
    <div class="serial_container">
    <p>Status</p> 
      <ul>
      <?php
        foreach ($sn_list as $sn) {
        ?>
        <li><?php echo $sn['activated'] ? 'Active':'Inactive' ?></li>
        <?php
        }
        ?>
      </ul>
    </div>
    </div>
</div>
<?php
}


}
