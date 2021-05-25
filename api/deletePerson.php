<?php
include_once 'api/idCheck.php';

class deletePerson
{
    private $error_flag = FALSE;

    public function delete_request($db)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $person_id = $data["person_id"];

        $idFounded = new idChecking();
        $idFounded = $idFounded->idCheck($db, $person_id);

        $query_string = "DELETE FROM person WHERE person_id = '" . $person_id . "'";
        $result = pg_query($db, $query_string);

        if (!$result) {
            http_response_code(400);
            $json_reply = array("error" => "Data type error");
            echo json_encode($json_reply);
            exit;
        } else {
            http_response_code(204);
        }
    }
}

?>