<?php 
    $host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'bakery';
    $sql_file_name = '../sql/bakery.sql';

    try {
        $connection = mysqli_connect($host, $db_user, $db_password);

        if ($connection -> connect_errno != 0){
            throw new Exception(mysqli_connect_errno());
        } else {
            $q = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name';";
            
            $result = $connection -> query($q);
            
            if ($result -> num_rows == 0) {
                $c_database = $connection -> query("CREATE DATABASE $db_name CHARACTER SET utf8 COLLATE utf8_general_ci;");

                if (!$c_database) {
                    throw new Exception($connection -> error);
                } else {
                    $sql_source = file_get_contents($sql_file_name);
                    $db = $connection -> select_db($db_name);
                    $c_tables = $connection -> multi_query($sql_source);

                    if (!$c_tables) {
                        throw new Exception($connection -> error);
                    }
                }
            } else {
                $db = $connection -> select_db($db_name);
            }
        }
        
    } catch (Exception $e) {
        echo "<p>Błąd serwera, przepraszamy za niedogodności i prosimy o rejestrację w terminie</p>";
        echo "<p>Błąd: ".$e."</p>";
        
        header("Location: ../../index.html");
    }
?>
