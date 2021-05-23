<?php

class patchPerson
{
    private $error_flag = FALSE;
    private $empty_info = NULL;

    public function patch_request($db)
    {
        $list_of_attributes_to_change = array();
        $person_id = !empty($_GET['person_id']) ? $_GET['person_id'] : $this->error_flag = TRUE .
            $this->empty_info .= 'ID не передан! </br>';
        if (!empty($_GET['person_email'])) {
            $person_email = $_GET['person_email'];
            $list_of_attributes_to_change[] = 'person_email';
        }
        if (!empty($_GET['person_name'])) {
            $person_name = $_GET['person_name'];
            $list_of_attributes_to_change[] = 'person_name';
        }
        if (!empty($_GET['person_lastname'])) {
            $person_lastname = $_GET['person_lastname'];
            $list_of_attributes_to_change[] = 'person_lastname';
        }
        if (!empty($_GET['person_age'])) {
            $person_age = $_GET['person_age'];
            $list_of_attributes_to_change[] = 'person_age';
        }

        if ($this->error_flag == TRUE) {
            echo "Ошибка!</br>";
            echo $this->empty_info;
            exit;
        } else {
            foreach ($list_of_attributes_to_change as $attribute_name) {
                $query_string = "UPDATE person SET " . $attribute_name . " = '" . $$attribute_name .
                    "' WHERE person_id = " . $person_id;
                $result = pg_query($db, $query_string);
                if (!$result) {
                    echo "Произошла ошибка.\n";
                    exit;
                } else {
                    echo "Успешно изменено! <br>";
                }
            }
        }
    }

}

?>