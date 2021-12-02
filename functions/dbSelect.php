<?php


// obsluga zapytan $_GET

if ((isset($_GET['cities']) && $_GET['cities'] != "") && (!isset($_GET['specialization']) || $_GET['specialization'] == "")) {

    $dbSearch = "Select p.firstName,p.lastName, COUNT(`visitId`) AS visitsCount FROM patients as p LEFT JOIN visits as v ON p.patientId = v.patientId INNER JOIN practitioners as pr ON v.practitionerId = pr.practitionerId WHERE p.city = '" . $_GET['cities'] . "' group by p.lastName";
    $searchResults = mysqli_query($conn, $dbSearch);
    $count = 0;

    while ($row = mysqli_fetch_assoc($searchResults)) {
        $count += $row['visitsCount'];
        echo '{[  "firstName" : "' . $row["firstName"] . '","secondName" : ' . $row["lastName"] . ',"countVisits" : ' . $row["visitsCount"] . ' ]}<br>';
    }
    echo '{[  "visitIn" : "' . $_GET['cities'] . '","Total" : ' . $count . ' }]<br>';

} else if (!isset($_GET['cities'])  && !isset($_GET['specialization'])) {

    $dbSearch = "Select p.city, p.firstName,p.lastName, COUNT(`visitId`) AS visitsCount FROM patients as p LEFT JOIN visits as v ON p.patientId = v.patientId INNER JOIN practitioners as pr ON v.practitionerId = pr.practitionerId group by p.lastName";
    $searchResults = mysqli_query($conn, $dbSearch);
    $count = 0;

    while ($row = mysqli_fetch_assoc($searchResults)) {
        $count += $row['visitsCount'];
        echo '{[  "city" : "' . $row["city"] . '  "firstName" : "' . $row["firstName"] . '","secondName" : ' . $row["lastName"] . ',"countVisits" : ' . $row["visitsCount"] . ' ]}<br>';
    }
    echo '{[  "Total" : ' . $count . ' }]<br>';

} else if ((isset($_GET['specialization']) && $_GET['specialization'] != "") && (isset($_GET['cities']) && $_GET['cities'] != "")) {

    $dbSearch = "Select p.city, pr.specialization, p.firstName,p.lastName, COUNT(`visitId`) AS visitsCount FROM patients as p LEFT JOIN visits as v ON p.patientId = v.patientId INNER JOIN practitioners as pr ON v.practitionerId = pr.practitionerId WHERE p.city = '" . $_GET['cities'] . "' AND pr.specialization = '" . $_GET['specialization'] . "' group by p.lastName";
    $searchResults = mysqli_query($conn, $dbSearch);
    $count = 0;
    while ($row = mysqli_fetch_assoc($searchResults)) {
        $count += $row['visitsCount'];

        echo '{[  "city" : "' . $row["city"] . ', "visit" : "' . $row["specialization"] . '  "firstName" : "' . $row["firstName"] . '","secondName" : ' . $row["lastName"] . ',"countVisits" : ' . $row["visitsCount"] . ' ]}<br>';
    }
    echo '{[  "visit" : "' . $_GET['specialization'] . '","Total" : ' . $count . ' }]<br>';
    
} else if (isset($_GET['specialization']) && $_GET['cities'] == "") {

    $dbSearch = "Select pr.specialization, COUNT(`visitId`) AS visitsCount FROM patients as p LEFT JOIN visits as v ON p.patientId = v.patientId INNER JOIN practitioners as pr ON v.practitionerId = pr.practitionerId WHERE pr.specialization = '" . $_GET['specialization'] . "' group by pr.specialization";
    $searchResults = mysqli_query($conn, $dbSearch);

    while ($row = mysqli_fetch_assoc($searchResults)) {
        echo '{[  "visit" : "' . $row["specialization"] . '","numberOfVists" : ' . $row["visitsCount"] . ' ]}<br>';
    }
}

?>
