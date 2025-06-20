<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../frontend/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard - PMPML</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
    }
    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
</head>
<body>
  <iframe src="../frontend/dashboard.html"></iframe>
</body>
</html>
