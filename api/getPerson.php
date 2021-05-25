<?php

class getPerson
{
    public function get_request($db)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $person_id = $data["person_id"];

        if (empty($person_id)) {
            $result = pg_query($db, "SELECT* FROM person");


        } else {
            $result = pg_query($db, "SELECT* FROM person WHERE person_id = " . $person_id);
        }
        if ($row = pg_fetch_array($result)) {
            $json_reply = array("id" => $row[0], "E-mail" => $row[1], "Name" => $row[2],
                "Lastname" => $row[3], "Age" => $row[4]);
            echo json_encode($json_reply);

            while ($row = pg_fetch_array($result)) {
                $json_reply = array("id" => $row[0], "E-mail" => $row[1], "Name" => $row[2],
                    "Lastname" => $row[3], "Age" => $row[4]);
                echo json_encode($json_reply);
                echo "\n";
            }

        } else {
            http_response_code(404);
            http_response_code();
        }
    }
}

?>