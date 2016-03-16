<?php
/**
* Plugin Name: BrandGate Table
* Description: Creates table in a database and lets insert data.
* Version: 1.0
* Author: Paulius Aleksiunas
*/

// database connection
$wpdb = new wpdb(get_option('bct_dbuser'), get_option('bct_dbpassword'), get_option('bct_dbname'), get_option('bct_dbhost'));

function bct_admin() {
    include( 'brandgate-table-admin.php' );
}

function bct_admin_action() {
    add_menu_page( 'BrandGate Table', 'BrandGate Table', 'administrator', 'bgc-settings', 'bct_admin' );
}
add_action( 'admin_menu', 'bct_admin_action' );

function bct_create_table($table_name) {
    // connect to database
    global $wpdb;

    // set default charset and collation
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
      name VARCHAR(255) NOT NULL,
      value MEDIUMINT(9) NOT NULL,
      PRIMARY KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'bct_create_table' );

function bct_get_table_data($rows_count = 1) {
    // output string
    $output = '';

    // connect to database
    global $wpdb;

    for ($i = 1; $i <= $rows_count; $i++) {
        // get name and value from database table
        $name = $wpdb ->get_var("SELECT name FROM user WHERE id = " . 1 );
        $value = $wpdb->get_var("SELECT value FROM user WHERE id = " . $i );

        // build output string
        $output .= '<div>';
        $output .= '<p>' . $name . ' - ' . $value . '</p>';
        $output .= '</div>';
    };

    return $output;
}

function bct_insert_data($table_name, $name, $value) {
    // connect to database
    global $wpdb;

    // insert data into table
    $wpdb->insert(
    	$table_name,
    	array(
    		'name' => $name,
    		'value' => $value
    	),
    	array(
    		'%s',
    		'%d'
    	)
    );
}
