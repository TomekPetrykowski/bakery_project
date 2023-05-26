<?php 



    function error_message_display(string $subject) {
        if (isset($_SESSION["$subject"])) {
            echo "<p class='error'>".$_SESSION["$subject"]."</p>";
            unset($_SESSION["$subject"]);
        }
    }


    function validate_login($login, $valid_data) {
        if (!ctype_alnum($login)){
            $valid_data = false;
            $_SESSION['e_login'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)!";
        }

        if (strlen($login) < 3 || strlen($login) > 20){
            $valid_data = false;
            $_SESSION['e_login'] = "Login musi mieć od 3 do 20 znaków!";
        }

        if (empty($login)) {
            $valid_data = false;
            $_SESSION['e_login'] = "Wymagane pole.";
        }

        return $valid_data;
    }

    function validate_email($email, $valid_data) {
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email != $_POST['email']){
                $valid_data = false;
                $_SESSION['e_email'] = "Podaj poprawny adres email!";
            }
        }

        return $valid_data;
    }

       
    function validate_password($password1, $password2, $valid_data) {
        if (strlen($password1) < 8 || strlen($password1) > 20){
            $valid_data = false;
            $_SESSION['e_password1'] = "Hasło musi posiadać od 8 do 20 znaków!";
        }

        if ($password1 != $password2){
            $valid_data = false;
            $_SESSION['e_password2'] = "Podane hasła nie są takie same!";
        }

        if (empty($password1)) {
            $valid_data = false;
            $_SESSION['e_password1'] = "Wymagane pole.";
        }

        
        if (empty($password2)) {
            $valid_data = false;
            $_SESSION['e_password2'] = "Wymagane pole.";
        }

        return $valid_data;
    }
        
    function validate_mail_code($mail_code, $valid_data) {
        if (!empty($mail_code)) {
           if (!preg_match("/^([0-9]{2})[-]?([0-9]{3})?$/i", $mail_code)) {
                $valid_data = false;
                $_SESSION['e_mail_code'] = "Podaj kod pocztowy w formacie XX-XXX.";
            }
        }

        return $valid_data;
    }

    function validate_is_empty(string $sub, string $subject, $valid_data) {
        if (empty($subject)) {
            $valid_data = false;
            $_SESSION[$sub] = "Wymagane pole.";
        }

        return $valid_data;
    }


    function raw_data(string $subject) {
        if(isset($_SESSION['raw_'.$subject])) { 
            echo $_SESSION['raw_'.$subject];
            unset($_SESSION['raw_'.$subject]); 
        }
    }

    function get_user_data($connection, $user_id) {
        if($connection) {
            $query = "SELECT * FROM clients WHERE id = '$user_id'";
            $result = $connection -> query($query);
            if ($result -> num_rows > 0) {
                $row = $result -> fetch_assoc();
                return $row;
            } else {
                throw new Exception($connection -> error);
            }
        } else {
            throw new Exception(($connection -> error));
        }

    }

    function randomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }

    function validate_img_file($product_file, $valid_data) {
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        
        $target = '';

        $file_extension = pathinfo($product_file["name"], PATHINFO_EXTENSION);

        if (!file_exists($product_file["tmp_name"])) {
            $valid_data = false;
            $_SESSION['e_file'] = "Wybierz zdjęcie do wysłania";
            
        } else if (!in_array($file_extension, $allowed_image_extension)) {
            $valid_data = false;
            $_SESSION['e_file'] = "Tylko pliki z rozszerzeniami .jpeg, .png i .jpg są poprawne!";
            
        } else {
            $target_path = "../../../assets/img/products/database/".randomString(12).'/';
            
            if(!is_dir($target_path)) {
                mkdir($target_path);
            }

            $target = $target_path.basename($product_file["name"]);
            if (move_uploaded_file($product_file["tmp_name"], $target)) {
                $valid_data = true;
            } else {
                $valid_data = false;
                $_SESSION['e_file'] = "Wystąpił błąd w dodawaniu pliku. Spróbuj ponownie później";
            }
        }
        unset($product_file['name']);

        return array('valid' => $valid_data, 'path' => $target);
    }
        
?>