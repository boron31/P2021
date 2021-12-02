<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

  <?php

  // plik konfiguracyjny
  include "config/config.php";

  // polaczenie z DB
  include "functions/dbConnect.php";

  // Sprawdzenie / Tworzenie DB
  include "functions/dbCreate.php";

  ?>
  <form method="GET">
    <label for="city">Choose a city:</label>
    <select name="cities">
      <?php
      include "functions\dbShowAllCities.php";
      ?>
    </select>
    <br>
    <label for="specialization">Choose a specialization:</label>
    <select name="specialization">
      <?php
      include "functions\dbShowAllspecialization.php";
      ?>
    </select>
    <br>
    <input type="submit" value="Submit">
    <br>
  </form>
  <form><input type="submit" value="Reset"></form>
  <?php

  include "functions/dbSelect.php";

  mysqli_close($conn)

  ?>

</body>

</html>