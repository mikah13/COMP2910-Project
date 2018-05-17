<?php

    function nameChk($first, $last)
    {
        return !empty($first) && !empty($last);
    }
    function passChk($password)
    {
        if (empty($password)) {
            return false;
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            return false;
        }
        return true;
    }


    function emailChk($conn, $email)
    {
        $result=mysqli_query($conn, "SELECT * from user WHERE email = '{$email}'");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    function existedChk($conn, $email){
        $result=mysqli_query($conn, "SELECT * from user WHERE email = '{$email}'");
        if (mysqli_num_rows($result) != 0) {
            return false;
        }
        return true;
    }
