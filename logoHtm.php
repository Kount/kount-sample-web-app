<?php
  $m = $_GET['m'];
  $s = $_GET['s'];
  header("HTTP/1.1 302 Found");
  header("Location: https://bta.kaptcha.com/logo.htm?m=$m&s=$s");




