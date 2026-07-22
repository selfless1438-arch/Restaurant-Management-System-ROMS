<?php

$conn = mysqli_connect('localhost', 'root', '', 'roms');
if (!$conn) {
    die('Connection Failed!');
    exit;
}
