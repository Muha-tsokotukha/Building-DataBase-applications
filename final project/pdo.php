<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'just2good2betrue');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>