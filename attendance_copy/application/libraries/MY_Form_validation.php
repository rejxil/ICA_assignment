<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    //load the original code using the constructor
    function __construct() {
        parent::__construct();
    }

    //set an error message without specifying rules
    //the code here references the original library
    public function set_error($field, $message) {
       $this->_field_data[$field]['error'] = $message;
    }

}
