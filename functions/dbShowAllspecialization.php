<?php
// wyświetlanie listy specjalizacji z DB

if (isset($_GET['specialization'])) {
  echo "<option selected value=" . $_GET['specialization'] . ">" . $_GET['specialization'] . "</option>}";
} else {
  echo "<option></option>}";
}

$sql = "SELECT `specialization` FROM `practitioners`";
$dbSearch = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($dbSearch)) {
  if ($_GET['specialization'] != $row['specialization']) {
    echo '<option value="' . $row['specialization'] . '">' . $row['specialization'] . '</option>';
  }
}


?>