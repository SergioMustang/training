<?php

class idChecking
{

    public function idCheck($db, $person_id)
    {
        $check = pg_query($db, "SELECT* FROM person WHERE person_id = '" . $person_id . "'");
        if (!$row = pg_fetch_array($check)) {
            http_response_code(404);
            $this->error_info[] = "ID not found!";
            $json_reply = array("error" => $this->error_info[0]);
            echo json_encode($json_reply);
            exit;
        } else {
            return true;
        }
    }
}