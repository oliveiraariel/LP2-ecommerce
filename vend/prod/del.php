<?php
include("../config.inc.php");
include("../session.php");
validaSessao();

if (!isset($_GET["id"]) || !$_GET["id"]) {
    header("Location: /sistema/vend/prod/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT * FROM prod WHERE id = '" . $_GET["id"] . "';";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 0) {
    header("Location: /sistema/vend/prod/");
    exit;
}

if (isset($_GET["del"]) && $_GET["del"] == "yes") {
    $sql = "DELETE FROM prod WHERE id = '" . $_GET["id"] . "';";
    $result = mysqli_query($link, $sql);
    header("Location: /sistema/vend/prod/");
    exit;
}

include("../../layout/header.php");
include("../menu.php")
?>

<br><br>Apagar produto<br><br>

Tem certeza que deseja apagar o produto "<?=$row["nome"];?>"?

<a href="/sistema/vend/prod/"><input type="button" value="Não"></a>
<a href="/sistema/vend/prod/del.php?id=<?=$row["id"];?>&del=yes"><input type="button" value="Sim"></a>

<?php
include("../../layout/footer.php");
?>