<?php
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From:  contato@gotalent.besaba.com\r\n"; // remetente
$headers .= "Return-Path: adaylon@gmail.com \r\n"; // return-path
$envio = mail('adaylon@gmail.com', 'teste', 'teste', $headers);
?>