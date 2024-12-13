<?php
include '../../controller/CoursController.php';
$CoursC = new CoursController();
$list = $CoursC->listCours();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Liste Cours - Dashboard</title>
    </head>
    <body>
        <table>
        <tr>
            <th>IDCours</th>
            <th>IDCreateur</th>
            <th>Title</th>
            <th>Category</th>
            <th>Creation_Date</th>
</tr>
<?php
foreach ($list as $cours)
{
    ?> <tr>
        <td><?=$cours['idCours'];?></td>
        <td><?=$cours['idCreateur'];?></td>
        <td><?=$cours['title'];?></td>
        <td><?=$cours['category'];?></td>
        <td><?=$cours['Creation_Date'];?></td>
        <td align="center">
            <form method="POST" action="updateCours.php">
                <input type="submit" name="update" value="Update">
                <input type="hidden" value=<?php echo $offer['id']; ?> name="id">
</form>
</td>
<td>
    <a href="deleteCours.php?idCours=<?php echo $offer['idCours'];?>">Delete</a>
</td>
</tr>
<?php
}
?>
</table>
</body>
</html>