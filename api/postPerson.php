<?php

class postPerson
{

    private $person_email;
    private $person_name;
    private $person_lastname;
    private $person_age;
    private $error_flag = FALSE;
    private $empty_info = NULL;

    public function post_request($db)
    {
        $this->person_email = !empty($_GET['person_email']) ? $_GET['person_email'] : $this->error_flag = TRUE .
            $this->empty_info .= 'E-mail не передан! </br>';
        $this->person_name = !empty($_GET['person_name']) ? $_GET['person_name'] : $this->error_flag = TRUE .
            $this->empty_info .= 'Имя не передано! </br>';
        $this->person_lastname = !empty($_GET['person_lastname']) ? $_GET['person_lastname'] : $this->error_flag = TRUE .
            $this->empty_info .= 'Фамилия не передана! </br> ';
        $this->person_age = !empty($_GET['person_age']) ? $_GET['person_age'] : $this->error_flag = TRUE .
            $this->empty_info .= 'Возраст не передан! </br>';

        if ($this->error_flag == TRUE) {
            echo "Ошибка!</br>";
            echo $this->empty_info;
            exit;
        } else {
            $query_string = "INSERT INTO person (person_id, person_email, person_name,
                person_lastname, person_age)
            VALUES (nextval('person_id_seq'),'" . $this->person_email . "','" . $this->person_name . "','" . $this->person_lastname .
                "'," . $this->person_age . ")";
            $result = pg_query($db, $query_string);
            if (!$result) {
                echo "Произошла ошибка.\n";
                exit;
            } else {
                echo "\nУспешно добавлено!";
            }
        }
    }
}

?>