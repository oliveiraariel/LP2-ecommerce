<?php
include("../config.inc.php");
include("../session.php");
validaSessao();
include("../../layout/header.php");
include("../menu.php");
?>

<br><br>CATEGORIAS<br><br>

<a href="/sistema/vend/categoria/add.php"><input type="button" value="+ Adicionar"></a>

<?php
$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT categoria_id, categoria FROM categoria ORDER BY categoria";
$result = mysqli_query($link, $sql);
echo "<br><br>";
echo "<table border='1px'>";
echo "<tr><th>Categoria</th><th>Editar</th><th>Apagar</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $id = (int) $row["categoria_id"];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["categoria"], ENT_QUOTES, "UTF-8") . "</td>";
    echo "<td><a href=\"/sistema/vend/categoria/upd.php?id=$id\" style=\"color:black;\">Editar</a></td>";
    echo "<td><a href=\"/sistema/vend/categoria/del.php?id=$id\" style=\"color:black;\">Apagar</a></td>";
    echo "</tr>";
}
echo "</table>";
?>

<?php include("../../layout/footer.php"); ?>
