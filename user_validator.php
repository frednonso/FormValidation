<?php
// create user validator class to handle validation
// constructor which takes in post data from form
// check required "fields to check" are present in the data
// create methods to validate individual fields
// -- a method to validate a username
// -- a method to validate an email
// -- return an error array once all checks are done


class UserValidator {
    private $data;
    private $errors = [];
    private static $fields = ["username", "email"];


    public function __construct($post_data) {
        $this->data = $post_data;

    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {   //if array key not present in post superglobal ie false
                trigger_error("$field not present in data");
                return;
            }

        }

        $this->validateUsername();
        $this->validateEmail();
        return $this->errors;

        

    }


    private function validateUsername() {
        $val = trim($this->data["username"]);

        if(empty($val)) {
            $this->addError("username", "username cannot be empty");
        }
        else {
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {  // if string pattern returns false
                $this->addError("username", "username must be 6-12 chars & alpha numeric");



            }
        }

    }

    private function validateEmail() {
        $val = trim($this->data["email"]);
        if(empty($val)) {
            $this->addError("email", "email cannot be empty");
        }
        else {
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)) {  // checks if email is valid
                $this->addError("email", "email must be a valid email");
            }
        }



    }


    private function addError($key, $val) {
        $this->errors[$key] = $val;

    }





}





?>