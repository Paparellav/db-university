<?php
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/Department.php";

//Proviamo una query

$sql = "SELECT * FROM `departments`;";
$result = $conn->query($sql);

//Controlliamo se il risultato è presente

if ($result && $result->num_rows > 0) {

  //Proviamo ad accedere ai valori
  while ($record = $result->fetch_assoc()) {
    $department = new Department($record["id"], $record["name"]);
    $departments[] = $department;
  }

} elseif ($result) {

} else {
  //Se si arriva all'else ci sono degli errori
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h3>Lista Dipartimenti</h3>
  <ul>
    <?php foreach ($departments as $department) { ?>
      <li>
        <small>
          <?php echo $department->name; ?>
        </small>
        <br>
        <a href="single-department.php?id=<?php echo $department->id ?>">Visualizza dettagli</a>
      </li>
    <?php } ?>
  </ul>
</body>

</html>