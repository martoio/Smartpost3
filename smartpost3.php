<?php
/*
 Plugin Name: Smartpost3
 Description: WIP
*/


if (defined('ABSPATH')) {

    register_activation_hook(__FILE__, 'smartpost3_install');

    function smartpost3_install(){

        global $wpdb;

       /* $table_name_regions = $wpdb->prefix . "regions";
        $table_name_producers = $wpdb->prefix . "producers";
        $table_name_wines = $wpdb->prefix . "wines";
        $table_name_schedule = $wpdb->prefix . "schedule";

        $sql_regions = "DROP TABLE IF EXISTS $table_name_regions; CREATE TABLE $table_name_regions (
        _id int(11) NOT NULL AUTO_INCREMENT,
        name_en varchar(128) NOT NULL,
        name_bg varchar(128) NOT NULL,
        hexcolor varchar(6) NOT NULL,
        PRIMARY KEY (_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;
        ";

        $sql_producers = "DROP TABLE IF EXISTS $table_name_producers; CREATE TABLE $table_name_producers (
        _id int(11) NOT NULL AUTO_INCREMENT,
        name_bg varchar(128) NOT NULL,
        name_en varchar(128) NOT NULL,
        region int(11) NOT NULL,
        info_bg text NOT NULL,
        info_en text NOT NULL,
        table_num int(3) NOT NULL,
        PRIMARY KEY (_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;";

        $sql_wines = "DROP TABLE IF EXISTS $table_name_wines; CREATE TABLE $table_name_wines (
        _id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(128) NOT NULL,
        producer int(11) NOT NULL,
        order_num int(11) NOT NULL,
        taste int(11) NOT NULL,
        color int(11) NOT NULL,
        nose int(11) NOT NULL,
        notes text NOT NULL,
        rating int(3) NOT NULL,
        PRIMARY KEY (_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;";

        $sql_schedule = "DROP TABLE IF EXISTS $table_name_schedule; CREATE TABLE $table_name_schedule (
        _id int(11) NOT NULL AUTO_INCREMENT,
        name_bg varchar(128) NOT NULL,
        name_en varchar(128) NOT NULL,
        location varchar(128) NOT NULL,
        `start` datetime NOT NULL,
        `end` datetime NOT NULL,
        PRIMARY KEY (_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_producers);
        dbDelta($sql_regions);
        dbDelta($sql_wines);
        dbDelta($sql_schedule);
        */
    }

    register_uninstall_hook( __FILE__, 'smartpost3_uninstall' );

    function smartpost3_uninstall() {
        global $wpdb;
        $table1 = $wpdb->prefix."wines";
        $table2 = $wpdb->prefix."regions";
        $table3 = $wpdb->prefix."producers";
        $table4 = $wpdb->prefix."schedule";

	    $wpdb->query("DROP TABLE IF EXISTS $table1");
	    $wpdb->query("DROP TABLE IF EXISTS $table2");
	    $wpdb->query("DROP TABLE IF EXISTS $table3");
	    $wpdb->query("DROP TABLE IF EXISTS $table4");
    }

    add_action('add_meta_boxes', 'divino_wines');

    
    //======================== 
    //======== Meta Box
    //========================
    function smartpost3_meta_box_declare(){

        add_meta_box('divino_meta', 'Find Wines', 'divino_meta_box', '', 'side', 'default');

    }
    function smartpost3_meta_box($post, $box) {

        global $wpdb;

        /*$producers = $wpdb->get_results(  "SELECT * FROM ".$wpdb->prefix."producers" );

        //custom meta box form elements
        echo 'Select a wine producer: <br>';
        echo '<select id="divino_filter">';
        echo '<option></option>';
        foreach($producers as $producer){
            echo '<option value="'.$producer->_id.'">'.$producer->name_en.'</option>';
        }
        echo '</select> <br>';
        echo 'Wines: ';
        foreach ($producers as $producer) {
            $wines = $wpdb->get_results(  "SELECT * FROM ".$wpdb->prefix."wines WHERE producer = $producer->_id ORDER BY order_num" );
            echo '<div class="divino_wine_container" style="display: none;" producer="'.$producer->_id.'">';
            foreach($wines as $wine) {
                echo '<p>'.$wine->name.'</p>';
            }
            echo '</div>';
        }*/

    }
    //=================
    //== End of Meta Box
    //=================



    //Action hook to add the divino menu item
    add_action( 'admin_menu', 'smartpost3_menu' );
    add_action( 'admin_init', 'smartpost3_script' );

    function smartpost3_menu() {

        add_menu_page(
            __( 'Smartpost Settings Page', 'smartpost-plugin'),
            __( 'Smartpost Settings', 'smartpost-plugin' ),
            'manage_options',
            'smartpost-settings',
            'smartpost_settings_page',
            'dashicons-clipboard',
            6
        );

    }

    //build the divino_settings_page()

    add_action( 'wp_enqueue_script', 'smartpost3_script');

    function smartpost3_script() {
        wp_register_script( 'smartpost_script', plugins_url('js/smartpost.js', __FILE__), array('jquery'), '1.0', true );
        wp_register_script( 'modal_effects', plugins_url('js/modalEffects.js', __FILE__), array('jquery'), '1.1', true );
        wp_register_script( 'classie', plugins_url('js/classie.js', __FILE__), array('jquery'), '1.1', true );

        wp_register_style( 'smartpost_css', plugins_url('css/smartpost3.css', __FILE__) );

        wp_enqueue_script( 'smartpost_script' );
        wp_enqueue_script( 'classie' );
        wp_enqueue_script( 'modal_effects' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'jquery-ui-accordion' );

        wp_enqueue_style( 'smartpost_css' );
        wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
    }

    /////// CODE FOR SETTINGS PAGE STARTS HERE //////

    function smartpost_settings_page() {
        //Calls function to include all the necessary classes (found in the plugin folder);
        include_classes();

        if(isset($_POST) && !empty($_POST)) {
            echo '<pre>';
            //print_r($_POST);
            echo '</pre>';

            $validator = new Validator('component', $_POST);
            $errors = $validator->errors();

        }

        if(!empty($errors)) {

            echo '<ul id="errors">';
            echo '<li>' . implode( '</li><li>', $errors) . '</li>';
            echo '</ul>';
        }
        
        //Checks if a tab is set in the GET parameters. If not, we set it to the default selected tab.
        if ( isset ( $_GET['tab'] ) ){
            smartpost_admin_tabs($_GET['tab']);
        } else { 
            smartpost_admin_tabs();
        }



    }

    function smartpost_admin_tabs( $current = 'components' ) {
        $tabs = array( 
            'components' => 'Components', 
            'themes' => 'Themes',
            'general' => 'General',
            'style' => 'Styling',
        );

        echo '<div id="icon-themes" class="icon32"><br></div>';
        
        echo '<h2 class="nav-tab-wrapper">';
        
        foreach( $tabs as $tab => $name ){
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=smartpost-settings&tab=$tab'>$name</a>";

        }
        echo '</h2>';


        //Calls function to create the content found underneath each tab;
        tab_content($current);
    }


    // Delegates the content generation of each tab to the SettingsBuilder class.
    function tab_content($tab = 'components'){

        $settingsBuilder = new SettingsBuilder($tab);

    }

    // Includes all the necessary classes that are called;
    function include_classes(){
        require_once 'SettingsBuilder.php';
        require_once 'Validator.php';
        require_once 'ValidateComponent.php';
        require_once 'ValidateTemplate.php';
    }

}