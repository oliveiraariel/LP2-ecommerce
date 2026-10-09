<?php
include("../config.inc.php");
include("../session.php");
validaSessao();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) { header("Location: /sistema/vend/categoria/"); exit; }

$link = mysqli_connect("localhost", "root", "", "sistema");
$stmt = mysqli_prepare($link, "SELECT categoria FROM categoria WHERE categoria_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
if (!$row) { header("Location: /sistema/vend/categoria/"); exit; }

if (isset($_GET["del"]) && $_GET["del"] === "yes") {
    $stmt = mysqli_prepare($link, "DELETE FROM categoria WHERE categoria_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: /sistema/vend/categoria/");
    exit;
}

include("../../layout/header.php");
include("../menu.php");
?>

<br><br>Apagar categoria<br><br>

Tem certeza que deseja apagar a categoria "<?=htmlspecialchars($row["categoria"], ENT_QUOTES, "UTF-8");?>"?<br>
Os produtos associados permanecem cadastrados, mas ficam sem categoria.

<a href="/sistema/vend/categoria/"><input type="button" value="Não"></a>
<a href="/sistema/vend/categoria/del.php?id=<?=$id;?>&del=yes"><input type="button" value="Sim"></a>

<?php include("../../layout/footer.php"); ?>
