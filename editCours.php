<?php

include '../../controller/CoursController.php';

$error="";

$cours=null;
$CoursController=new CoursController();

if 
(
    isset ($_POST["idCourse"]) && $_POST["idCreator"] && $_POST["title"] && $_POST["category"] && $_POST["descript"] && $_POST["Creation_Date"]
) 
{
    if 
    (
        !empty($_POST["idCourse"]) && !empty($_POST["idCreator"]) && !empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["descript"]) && !empty($_POST["Creation_Date"])
    )
    {
        $cours=new Cours(
            null,
            null,
            $_POST['title'],
            $_POST['category'],
            $_POST['descript'],
            new DateTime($_POST['Creation_Date'])
        );
        $CoursController->updateCours($cours, $_POST['idCours']);
        header('Location:listCours.php');
    }
    else
    $error="Missing Information";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Cours - Dashboard</title>
</head>
<body>
    