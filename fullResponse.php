<?php

$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}

$responseArray =  $_SESSION['responseArray'];

?>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
  body {
    background-color: #E7E3E0;
  }

  table.fullResponse tr {
    line-height: 30px;
  }

  table.fullResponse td {
    padding: 5px;
  }
</style>

<table class="fullResponse">

  <h3 class="heading"> Full list of RIS response fields</h3>

  <?php foreach ($responseArray as $key => $res) {
    echo '<tr>';
    echo '<td><label class="formLabel" for="">' . $key . '</label></td>';
    echo "<td><input class='form-control' type='text' name='name' value='$res' readonly> </input></td>";
    echo '</tr>';
  }
  ?>
</table>



