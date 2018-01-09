<?php

# CLASS FRONTEND

class gsdh_frontend{

	# CONSTRUCT
	public function __construct(){

        $this->check = new gsdh_check();

    }

	# GET OPTIONS
    public function gsdh_get_options(){

        # GET OPTION DATA
        $options = get_option( 'gsdh_theme_options' );

        # RETURN
        return $options;

    }

    public function gsdh_booking()
    {

        $form_data = array();
        parse_str($_POST['data'], $form_data);

        #VALIDATE DATA
        $status = true;

        #NAME
        if(isset($form_data['user_name']) &&$this->check->gsdh_checkString($form_data['user_name'])){
            $user_name = true;
        }else{
            $user_name = false;
            $status = false;
        }

        #EMAIL
        if(isset($form_data['user_email']) && $this->check->gsdh_checkEmail($form_data['user_email'])){
            $user_email = true;
        }else{
            $user_email = false;
            $status = false;
        }

        #DATE
        if(isset($form_data['user_date']) && $this->check->gsdh_checkString($form_data['user_date'])){
            $user_date = true;
        }else{
            $user_date = false;
            $status = false;
        }

        #TEL
        if(isset($form_data['user_tel']) && $this->check->gsdh_checkString($form_data['user_tel'])){
            $user_tel = true;
        }else{
            $user_tel = false;
            $status = false;
        }

        #RESPOND
        if($status){

            $args = array(
                'post_type' => 'bookings',
                'post_status' => 'publish',
                'orderby' => 'post-date',
                'order' => 'DESC',
                'numberposts' => -1
            );

            # GET POSTS
            $bookings = get_posts( $args );

            $my_error = true;

            if(!empty($bookings)){
                foreach($bookings as $s){
                    $saved_email = get_post_meta($s->ID, 'gsdh_bookings_email', true);
                    if ( $form_data['user_email'] == $saved_email ) {
                        $my_error = false;
                    }
                }
            }

            if ( $my_error == true ) {

                #VARIABLES
                //$admin_email = get_option( 'admin_email' );
                $admin_email = 'activ@immobilien-strobl.de';
                $user_name = $form_data['user_name'];
                $user_email = $form_data['user_email'];
                $user_tel = $form_data['user_tel'];
                $user_date = $form_data['user_date'];

                #HEADERS
                $headers = array(
                    "From:" .$user_name. " <".$user_email.">",
                    "Bcc:".$admin_email,
                );

                $message = '
Sehr geehrte Frau/ Herr '.$user_name.',
 
vielen Dank für Ihre Nachricht. Wir werden diese nach Erhalt umgehend bearbeiten und uns direkt mit Ihnen persönlich in Verbindung setzten.

Mit freundlichen Grüßen
Maximilian Strobl
ACTIV Immobilienmangement
STROBL Immobilien
                
Buchungsdetails:
Name: '.$user_name.' 
Email: '.$user_email.' 
Telefonnummer: '.$user_tel.' 
Datum: '.$user_date.'
                         
';

                #SEND EMAIL
                wp_mail($user_email, 'Strobl - Booking: ', $message, $headers, array());

                #ADD
                $query_post = array(
                    'post_status'		=> 'publish',
                    'post_type'			=> 'bookings',
                    'post_title'		=> $user_name . ' | ' . $user_email
                );

                $post_id = wp_insert_post($query_post);

                #RETURN ARRAY
                $return_array = array(
                    'status' => $status,
                    'insert_msg' => 'Message sent!',
                    'id' => $post_id,
                );

                # SAVE DATA TO NEW POST
                add_post_meta($post_id, 'gsdh_bookings_name',  $form_data['user_name']);
                add_post_meta($post_id, 'gsdh_bookings_email',  $form_data['user_email']);
                add_post_meta($post_id, 'gsdh_bookings_tel',  $form_data['user_tel']);
                add_post_meta($post_id, 'gsdh_bookings_message',  $form_data['user_message']);
                add_post_meta($post_id, 'gsdh_bookings_date',  $form_data['user_date']);

                #NO ERRORS
                echo json_encode($return_array);
                exit();

            } else {

                #NO ERRORS
                echo json_encode('exist');
                exit();

            }


        }else{

            #ERROR ARRAY
            $error_array = array(
                'status' => $status,
                'insert_msg' => 'Your form has erros\'s!',
                'fields' => array(
                    'user_name' => $user_name,
                    'user_date' => $user_date,
                    'user_email' => $user_email,
                    'user_tel' => $user_tel,
                ),
            );

            #RETURN
            echo json_encode($error_array);
            exit();

        }

    }

    public function gsdh_request()
    {

        $form_data = array();
        parse_str($_POST['data'], $form_data);

        #VALIDATE DATA
        $status = true;

        #NAME
        if(isset($form_data['user_name']) &&$this->check->gsdh_checkString($form_data['user_name'])){
            $user_name = true;
        }else{
            $user_name = false;
            $status = false;
        }

        #EMAIL
        if(isset($form_data['user_email']) && $this->check->gsdh_checkEmail($form_data['user_email'])){
            $user_email = true;
        }else{
            $user_email = false;
            $status = false;
        }

        #TEL
        if(isset($form_data['user_tel']) && $this->check->gsdh_checkString($form_data['user_tel'])){
            $user_tel = true;
        }else{
            $user_tel = false;
            $status = false;
        }


        #RESPOND
        if($status){

            $args = array(
                'post_type' => 'request',
                'post_status' => 'publish',
                'orderby' => 'post-date',
                'order' => 'DESC',
                'numberposts' => -1
            );

            # GET POSTS
            $requests = get_posts( $args );

            $my_error = true;

            if(!empty($requests)){
                foreach($requests as $s){
                    $saved_email = get_post_meta($s->ID, 'gsdh_request_email', true);
                    if ( $form_data['user_email'] == $saved_email ) {
                        $my_error = false;
                    }
                }
            }

            if ( $my_error == true ) {

                #VARIABLES
                $admin_email = 'activ@immobilien-strobl.de';
                $user_name = $form_data['user_name'];
                $user_email = $form_data['user_email'];
                $user_tel = $form_data['user_tel'];

                #HEADERS
                $headers = array(
                    "From:" .$user_name. " <".$user_email.">",
                    "Bcc:".$admin_email,
                );

                $message = '
                
Sehr geehrte Frau/ Herr '.$user_name.',
 
vielen Dank für Ihre Nachricht. Wir werden diese nach Erhalt umgehend bearbeiten und uns direkt mit Ihnen persönlich in Verbindung setzten.

Mit freundlichen Grüßen
Maximilian Strobl
ACTIV Immobilienmangement
STROBL Immobilien
                
Rückrufdetails:
Name: '.$user_name.' 
Email: '.$user_email.' 
Telefonnummer: '.$user_tel.'
                         
';

                #SEND EMAIL
                wp_mail($user_email, 'Strobl - Callback Request: ', $message, $headers, array());

                #ADD
                $query_post = array(
                    'post_status'		=> 'publish',
                    'post_type'			=> 'request',
                    'post_title'		=> $user_name . ' | ' . $user_email
                );

                $post_id = wp_insert_post($query_post);

                #RETURN ARRAY
                $return_array = array(
                    'status' => $status,
                    'insert_msg' => 'Message sent!',
                    'id' => $post_id,
                );

                # SAVE DATA TO NEW POST
                add_post_meta($post_id, 'gsdh_request_name',  $form_data['user_name']);
                add_post_meta($post_id, 'gsdh_request_email',  $form_data['user_email']);
                add_post_meta($post_id, 'gsdh_request_tel',  $form_data['user_tel']);

                #NO ERRORS
                echo json_encode($return_array);
                exit();

            } else {

                #NO ERRORS
                echo json_encode('exist');
                exit();

            }


        }else{

            #ERROR ARRAY
            $error_array = array(
                'status' => $status,
                'insert_msg' => 'Your form has erros\'s!',
                'fields' => array(
                    'user_name' => $user_name,
                    'user_tel' => $user_tel,
                    'user_email' => $user_email,
                ),
            );

            #RETURN
            echo json_encode($error_array);
            exit();

        }

    }
	
}