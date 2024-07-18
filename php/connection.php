<?php
    function connectDB() {
        $conn = new mysqli("localhost", "root", "", "kpophub"); 
        return $conn;
    }
?>