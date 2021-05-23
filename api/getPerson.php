<?php

class getPerson
{

    private $person_id;

    public function get_request($db)
    {
        $this->person_id = $_GET['person_id'];

        if (empty($this->person_id)) {
            $result = pg_query($db, "SELECT * FROM person");
        } else {
            $result = pg_query($db, "SELECT * FROM person WHERE person_id = " . $this->person_id);
        }
        if (!$result) {
            echo "Произошла ошибка.\n";
            exit;
        }
        while ($row = pg_fetch_row($result)) {
            $json_reply = array("id" => $row[0], "E-mail" => $row[1], "Name" => $row[2],
                "Lastname" => $row[3], "Age" => $row[4]);
            echo json_encode($json_reply);
            echo "\n";
        }

    }
}

?>