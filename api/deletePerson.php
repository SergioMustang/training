<?php

class deletePerson
{
    private $error_flag = FALSE;

    public function delete_request($db)
    {
        if (!empty($_GET['person_id'])) {
            $person_id = $_GET['person_id'];
        } else {
            echo "Ошибка!</br>";
            exit;
        }
        $query_string = "DELETE FROM person WHERE person_id = " . $person_id;
        $result = pg_query($db, $query_string);
        if (!$result) {
            echo "Произошла ошибка.\n";
            exit;
        } else {
            echo "Успешно удалено! <br>";
        }
    }
}

?>