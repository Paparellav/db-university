<?php

require_once __DIR__ . "/db.php";
require_once __DIR__ . "/Department.php";

//Prepare a statement
$stmt = $conn->prepare("SELECT * FROM `departments` WHERE `id`= ?");
$stmt->bind_param("d", $id);
$id = $_GET["id"];
$stmt->execute();

//Result
$result = $stmt->get_result();

$departments = [];

if ($result && $result->num_rows > 0) {

  while ($record = $result->fetch_assoc()) {
    $department = new Department($record["id"], $record["name"]);
    $department->setContactInfo($record["address"], $record["phone"], $record["email"], $record["website"]);
    $department->head_of_department = $record["head_of_department"];
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
  <br>
  <a id="padding-2" href="index.php">Back to departments' list</a>

  <?php foreach ($departments as $department) { ?>
    <h2>
      <?php echo $department->name; ?>
    </h2>
    <p>
      Head of department: <?php echo $department->head_of_department; ?>
    </p>
    <h3>Contacts</h3>
    <ul>
      <?php foreach ($department->getContactsAsArray() as $key => $value) { ?>
        <li>
          <small>
            <?php echo "$key: $value;" ?>
          </small>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>
</body>

</html>