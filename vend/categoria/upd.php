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
$nome = $row["categoria"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["categoria"] ?? "");
    if (!$nome) {
        $erro = "Categoria Vazia";
    } else {
        $stmt = mysqli_prepare($link, "UPDATE categoria SET categoria = ? WHERE categoria_id = ?");
        mysqli_stmt_bind_param($stmt, "si", $nome, $id);
        mysqli_stmt_execute($stmt);
        header("Location: /sistema/vend/categoria/");
        exit;
    }
}

include("../../layout/header.php");
include("../menu.php");
?>

<br><br>Editar categoria<br><br>

<?php if (isset($erro)) echo "<span style=\"color:red; font-style: italic;\">" . htmlspecialchars($erro, ENT_QUOTES, "UTF-8") . "</span>"; ?>

<form method="post">
    <table>
        <tr>
            <td>Categoria:</td>
            <td><input type="text" name="categoria" value="<?=htmlspecialchars($nome, ENT_QUOTES, "UTF-8");?>"></td>
        </tr>
        <tr><td></td><td><input type="submit" value="Editar"></td></tr>
    </table>
</form>

<?php include("../../layout/footer.php"); ?>
