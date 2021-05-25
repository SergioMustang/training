<?php
include_once 'api/uuitGeneration.php';

class postPerson
{
    private $error_flag = FALSE;
    private $error_info = array();

    public function post_request($db)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $person_email = $data["person_email"];
        $person_name = $data["person_name"];
        $person_lastname = $data["person_lastname"];
        $person_age = $data["person_age"];

        if (empty($person_email)) {
            $this->error_info[] = 'E-mail not entered!';
            $this->error_flag = TRUE;
        }
        if (empty($person_name)) {
            $this->error_info[] = 'Name not entered!';
            $this->error_flag = TRUE;
        }
        if (empty($person_lastname)) {
            $this->error_info[] = 'Lastname not entered!';
            $this->error_flag = TRUE;
        }
        if (empty($person_age)) {
            $this->error_info[] = 'Age not entered!';
            $this->error_flag = TRUE;
        }


        if ($this->error_flag == TRUE) {
            http_response_code(400);
            $json_reply = array("error" => $this->error_info[0]);
            echo json_encode($json_reply);
            exit;

        } else {
            $uuit_Generator = new  uuitGeneration;
            $uuit = $uuit_Generator->genUuit();

            $query_string = "INSERT INTO person (person_id, person_email, person_name,
                person_lastname, person_age)
            VALUES ('" . $uuit . "','" . $person_email . "','" . $person_name . "','" . $person_lastname .
                "','" . $person_age . "')";
            $result = pg_query($db, $query_string);
            if (!$result) {
                http_response_code(400);
                $this->error_info[] = "Data type error";
                $json_reply = array("error" => $this->error_info[0]);
                echo json_encode($json_reply);
                exit;
            } else {
                http_response_code(201);
                $success = array();
                $success[] = $uuit;
                $json_reply = array("uuid" => $success[0]);
                echo json_encode($json_reply);
            }
        }
    }
}

?>