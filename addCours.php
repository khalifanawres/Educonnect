<?php

include '../../controller/CoursController.php';

$error = "";

$cours=null;
$courscontroller=new CoursController();

if (
    isset ($_POST["idCourse"]) && $_POST["idCreator"] && $_POST["title"] && $_POST["category"] && $_POST["descript"] && $_POST["Creation_Date"]
) {
    if (!empty($_POST["idCourse"]) && !empty($_POST["idCreator"]) && !empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["descript"]) && !empty($_POST["Creation_Date"])
    ) {
$cours = new Cours(
    null,
    $_POST[''],
    $_POST['title'],
    $_POST['category'],
    $_POST['descript'],
    new DateTime($_POST['Creation_Date'])
);
$CoursController->addCours($cours);
header ('Location:listCours.php');
    }
    else 
    $error = "Missing information";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <title> Add Course - Dashboard</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
</head>
<body>
    <form id="addCoursForm" action="" method="POST">
        <label for="title">Title:</label><br>
        <input class="form-control form-control-user" type="text" id="title" name="title">
        <span id="title_error"></span><br>

        <label for="category">Category:</label><br>
        <select class="form-control form-control-user" id="category" name="category">
            <option value="science">Science</option>
            <option value="informatique">Informatique</option>
            <option value="math">Mathematique</option>
</select>
<br>

        <label for="title">descript:</label><br>
        <input type="text" id="descript" name="descript">
        <span id="descript_error"></span><br>

        <label for="idCreator">ID Creator:</label><br>
        <input class="form-control form-control-user" type="number" id="idCreator" name="idCreator">
        <span id="title_error"></span><br>
        <input type="submit" value="submit">
</form>
</body>
</html>

