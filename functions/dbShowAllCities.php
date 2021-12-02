<?php

// wyświetlanie listy miast z DB

if (isset($_GET['cities'])) {
  echo "<option selected value=" . $_GET['cities'] . ">" . $_GET['cities'] . "</option>}";
} else {
  echo "<option selected></option>}";
}

$sql = "SELECT DISTINCT city FROM `patients`";
$dbSearch = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_assoc($dbSearch)) {
  if ($_GET['cities'] != $row['city']) {
    echo '<option value="' . $row['city'] . '">' . $row['city'] . '</option>';
  }
}


?>