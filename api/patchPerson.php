<?php

class patchPerson
{
    private $error_flag = FALSE;
    private $error_info = array();

    public function patch_request($db)
    {
        //Считываем входные данные
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $person_id = $data["person_id"];
        $person_email = $data["person_email"];
        $person_name = $data["person_name"];
        $person_lastname = $data["person_lastname"];
        $person_age = $data["person_age"];

        $list_of_attributes_to_change = array();

        //Вывод ошибки - ID не введён
        if (empty($person_id)) {
            http_response_code(400);
            $json_reply = array("error" => "ID not entered!");
            echo json_encode($json_reply);
            exit;
        }
        if (!empty($person_email)) {
            $list_of_attributes_to_change[] = 'person_email';
        }
        if (!empty($person_name)) {
            $list_of_attributes_to_change[] = 'person_name';
        }
        if (!empty($person_lastname)) {
            $list_of_attributes_to_change[] = 'person_lastname';
        }
        if (!empty($person_age)) {
            $list_of_attributes_to_change[] = 'person_age';
        }

        $check = pg_query($db, "SELECT* FROM person WHERE person_id = '" . $person_id . "'");
        if (!$row = pg_fetch_array($check)) {
            http_response_code(404);
            $this->error_info[] = "ID not found!";
            $json_reply = array("error" => $this->error_info[0]);
            echo json_encode($json_reply);
            exit;
        }
        foreach ($list_of_attributes_to_change as $attribute_name) {
            $query_string = "UPDATE person SET " . $attribute_name . " = '" . $$attribute_name .
                "' WHERE person_id = '" . $person_id . "'";
            $result = pg_query($db, $query_string);
        }
        if (!$result) {
            http_response_code(400);
            $this->error_info[] = "Data type error";
            $json_reply = array("error" => $this->error_info[0]);
            echo json_encode($json_reply);
            exit;
        } else {
            http_response_code(201);
            $success = array();
        }
    }
}

?>