<?php

/**
 * Ajax tasks
 * 
 */


//add_action( 'wp_ajax_process_registration_form', __NAMESPACE__ . '\\process_registration_form' );
//add_action( 'wp_ajax_nopriv_process_registration_form', __NAMESPACE__ . '\\process_registration_form' );

/*
function process_registration_form() {

  $errors = array();

  $fileErrors = array(
		0 => "There is no error, the file uploaded with success",
		1 => "The uploaded file exceeds the upload_max_files in server settings",
		2 => "The uploaded file exceeds the MAX_FILE_SIZE from html form",
		3 => "The uploaded file uploaded only partially",
		4 => "No file was uploaded",
		6 => "Missing a temporary folder",
		7 => "Failed to write file to disk",
    8 => "A PHP extension stoped file to upload" 
  );

  $user_id = $_POST["user_id"];
  $grade = $_POST["grade"];
  $discipline = $_POST["discipline"];
  $avatar = (isset($_FILES)) ? $_FILES : array();
  $school = $_POST["school"];
  $school_name = $_POST["school_name"];
  $school_board = $_POST["school_board"];

  // verify nonce for security
  if ( !isset($_POST['nonce']) && !wp_verify_nonce( $_POST['nonce'], "user_registration_process")) {
    exit("registration not valid");
  }

  // test if user exists in the database
  if ( empty($user_id) && !get_user_by( 'id', $user_id ) ) {
    exit("registration not valid");
  }
  
  if ( empty($grade) ) {
    array_push( $errors, array(
      'field' => 'grade',
      'message' => __('Veuillez sélectionner un niveau', 'banq-ntni'),
    ) );
  }
  
  if ( empty($discipline) ) {
    array_push( $errors, array(
      'field' => 'discipline',
      'message' => __('Veuillez sélectionner une discipline', 'banq-ntni'),
    ) );
  }
  
  if ( empty($school) ) {
    array_push( $errors, array(
      'field' => 'school',
      'message' => __('Veuillez sélectionner une école', 'banq-ntni'),
    ) );
  }

  // school creation - choice other
  if ( $school==='other') {
    if (empty($school_name) ) {
      array_push( $errors, array(
        'field' => 'school',
        'message' => __("Veuillez entrer le nom de l'école", "banq-ntni"),
      ) );
    }

    if (empty($school_board) ) {
      array_push( $errors, array(
        'field' => 'school_board',
        'message' => __("Veuillez sélectionner une commission scolaire", "banq-ntni"),
      ) );
    }
  }

  if ( empty($errors) ) {

    //user grades
    $grades = explode(',', $grade);
    $grade_acf_field = 'field_5ce84809a01a2';
    update_field( $grade_acf_field, $grades, 'user_'.$user_id );

    //user disciplines
    $disciplines = explode(',', $discipline);
    $discipline_acf_field = 'field_5ce847b4a01a1';
    update_field( $discipline_acf_field, $disciplines, 'user_'.$user_id );

    //school
    
    // create school
    if ( $school==='other' ) {
      $new_school_data = array(
        'post_title'    => wp_strip_all_tags( $school_name ),
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'school',
      );
      $post_id = wp_insert_post( $new_school_data );

      if($post_id) {
        $school_board_acf_field = 'field_5ceffbbcecd33';
        update_field( $school_board_acf_field, $school_board, $post_id );

        $school = $post_id;
      }
    }

    //user school
    $school_acf_field = 'field_5ce84824a01a3';
    update_field( $school_acf_field, $school, 'user_'.$user_id );

    //user avatar
    if ( isset($avatar) ) {
      if (!function_exists('wp_generate_attachment_metadata')){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
      }
      if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                return "upload error : " . $_FILES[$file]['error'];
            }
            $uploaded_file_id = media_handle_upload( $file, $new_post );
            if( !$uploaded_file_id || isset( $uploaded_file_id['error'] ) ) {
              array_push( $errors, array(
                'field' => 'avatar',
                'message' => $uploaded_file_id['error'],
              ) );
            }else{
              $avatar_acf_field = 'field_5cfaa5f1b8cf0';
              update_field( $avatar_acf_field, $uploaded_file_id, 'user_'.$user_id );
            }
        }   
      }
    }

    $result['status'] = 'success';
    $result['url'] = get_permalink( get_field('profile_page', 'options') );
    
  }else {
    $result['status'] = 'errors';
    $result['errors'] = $errors;
  }

  // Check if action was fired via Ajax call. If yes, JS code will be triggered, else the user is redirected to the post page
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
  }

  die();
}
*/