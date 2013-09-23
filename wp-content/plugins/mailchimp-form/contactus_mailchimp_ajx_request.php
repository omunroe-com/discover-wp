<?php

// checkMCapikey handler function...
add_action('wp_ajax_cUsMC_checkMCapikey', 'cusMC_checkMCapikey_callback');
function cusMC_checkMCapikey_callback() {
        
    $api_key = trim($_REQUEST[apikey]);

    //apis instances
    $MC_api = new mailchimpSF_MCAPI($api_key);//MC API // trying to make just one call since 1.2
    $userData = $MC_api->getAccountDetails();
    
    if ( $userData ):
        
        $cUsMC_userData = array(
            'fname' => $userData[contact][fname],
            'lname' => $userData[contact][lname],
            'email' => $userData[contact][email],
            'MC_apikey' => $api_key
        );

        $MC_lists = $MC_api->lists(array(),0,100);
        $MC_lists = $MC_lists['data'];

        update_option('cUsMC_settings_MC_lists', $MC_lists);
        update_option('cUsMC_settings_userData', $cUsMC_userData);
        
        echo 1; //VALID APIKEY

    else:
        echo 2; //INVALID APIKEY
    //echo 'There something wrong with your MailChimp API Key, please try again!';
    endif;
        
    die();
}

// getMCList handler function...
add_action('wp_ajax_cUsMC_getMCList', 'cUsMC_getMCList_callback');
function cUsMC_getMCList_callback() {
    
    $MC_lists = get_option('cUsMC_settings_MC_lists'); //get the saved mailchimp user LIST MATRIX
    $userData = get_option('cUsMC_settings_userData'); //get the saved mailchimp user data
    $xHTML = '';

    if($userData):
        
        if ( is_array($MC_lists) && !empty($MC_lists) ) :
            
            foreach( $MC_lists as $key => $list ) { $xHTML .= '<option value="'.$list['id'].'">'.$list['name'].'</option>'; }
            
            $aryResponse = array(
                'options'   => $xHTML,
                'fname'     => $userData[fname],
                'lname'     => $userData[lname],
                'email'     => $userData[email]
            );
            
        else:
            $aryResponse = array('status' => 1); //empty matrix list
        endif;

    else:    
        $aryResponse = array('status' => 2); // no user data
    endif;
    
    echo json_encode($aryResponse);
    
    die();
}

// sendClientList handler function...
add_action('wp_ajax_cUsMC_sendClientList', 'cUsMC_sendClientList_callback');
function cUsMC_sendClientList_callback() {
    
    
    if      ( !strlen($_REQUEST[fName]) ):      echo 'Missing First Name, is required fieldsss!';      die();
    elseif  ( !strlen($_REQUEST[lName]) ):      echo 'Missing Last Name, is required field!';       die();
    elseif  ( !strlen($_REQUEST[Email]) ):      echo 'Missing/Invalid Email, is required field!';   die();
    elseif  ( !strlen($_REQUEST[website]) ):    echo 'Missing Website, is required field!';         die();
    else:
    
        $cUsMC_userData = get_option('cUsMC_settings_userData'); //get the saved mailchimp user data
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
        
        $postData = array(
            'fname' => $_REQUEST[fName],
            'lname' => $_REQUEST[lName],
            'email' => $_REQUEST[Email],
            'MC_apikey' => $cUsMC_userData[MC_apikey],
            'website' => $_REQUEST[website],
            'listID' => $_REQUEST['listID'],
            'mcListName' => $_REQUEST['mcListName']
        );

        $cUsMC_API_result = $cUsMC_api->createCustomer($postData);
        update_option('cUsMC_settings_userData', $postData);

        if($cUsMC_API_result) :

            $cUs_json = json_decode($cUsMC_API_result);

            switch ( $cUs_json->status  ) :

                case 'success':
                    echo 1;//GREAT
                    update_option('cUsMC_settings_form_key', $cUs_json->form_key ); //finally get form key form contactus.com // SESSION IN
                    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
                        'tab_user'          => 1,
                        'cus_version'       => 'tab'
                    ); 
                    update_option('cUsMC_FORM_settings', $aryFormOptions );//UPDATE FORM SETTINGS
                    
                break;

                case 'error':

                    if($cUs_json->error[0] == 'Email exists'):
                        echo 2;//ALREDY CUS USER
                        //$cUsMC_api->resetData(); //RESET DATA
                    else:
                        //ANY ERROR
                        echo $cUs_json->error;
                        //$cUsMC_api->resetData(); //RESET DATA
                    endif;
                break;
                

            endswitch;
         else:
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsMC_api->resetData(); //RESET DATA
         endif;
         
     endif;
    
    die();
}

// loginAlreadyUser handler function...
add_action('wp_ajax_cusMC_loginAlreadyUser', 'cUsMC_loginAlreadyUser_callback');
function cUsMC_loginAlreadyUser_callback() {
    $cUsMC_api = new cUsComAPI_MC();
    $cUs_email = $_REQUEST['email'];
    $cUs_pass = $_REQUEST['pass'];
    $cUsMC_userData = get_option('cUsMC_settings_userData'); //get the saved mailchimp user data
    
    $postData = array(
        'fname' => $cUsMC_userData[fname],
        'lname' => $cUsMC_userData[lname],
        'email' => $cUsMC_userData[email],
        'password' => $cUs_pass,
        'MC_apikey' => $cUsMC_userData[MC_apikey],
        'website' => $_SERVER['HTTP_HOST'],
        'listID' => $cUsMC_userData[listID],
        'mcListName' => $cUsMC_userData[mcListName]
    );
    
    $cUsMC_API_result = $cUsMC_api->getFormKeyAPI($cUs_email, $cUs_pass); //api hook;
    if($cUsMC_API_result){
        $cUs_json = json_decode($cUsMC_API_result);

        switch ( $cUs_json->status  ) :
            case 'success':
                $cUsMC_API_UPDATE = $cUsMC_api->updateDeliveryOptions($postData, $cUs_json->form_key); //UPDATE DELIVERY OPTIONS;
                update_option('cUsMC_settings_form_key', $cUs_json->form_key);
                //update_option('cUsMC_settings_userData', $postData);
                $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
                    'tab_user'          => 1,
                    'cus_version'       => 'tab'
                ); 
                update_option('cUsMC_FORM_settings', $aryFormOptions );//UPDATE FORM SETTINGS
                echo 1;
                break;

            case 'error':
                echo $cUs_json->error;
                $cUsMC_api->resetData(); //RESET DATA
                break;
        endswitch;
    }
    
    die();
}

// logoutUser handler function...
add_action('wp_ajax_cUsMC_logoutUser', 'cUsMC_logoutUser_callback');
function cUsMC_logoutUser_callback() {
    
    $cUsMC_api = new cUsComAPI_MC();
    $cUsMC_api->resetData(); //RESET DATA
    
    delete_option( 'cUsMC_settings_api_key' );  
    delete_option( 'cUsMC_settings_form_key' );  
    delete_option( 'cUsMC_settings_list_Name' );  
    delete_option( 'cUsMC_settings_list_ID' );  
    
    echo 'Deleted.... User data'; //none list
    
    die();
}

// sendTemplateID handler function...
add_action('wp_ajax_cUsMC_sendTemplateID', 'cUsMC_sendTemplateID_callback');
function cUsMC_sendTemplateID_callback() {
    echo 1; //none list
    
    die();
}


?>
