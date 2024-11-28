<?php

// Librería de código con funciones del programa

function conexion() {
    $db = new mysqli("localhost", "root", "", "proyecto_iaw");
    $db->query("SET NAMES utf8");
    return $db;
}