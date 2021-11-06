<?php

    include 'config.php';

    function retrieve_data($sql){
        $conn = conn_db();
        $res = $conn->query($sql);
        return $res;
    }

    function clean_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>