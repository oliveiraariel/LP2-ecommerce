<?php
include("../config.inc.php");
include("../session.php");
validaSessao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["categoria"] ?? "");
    if (!$nome) {
        $erro = "Categoria Vazia";
    } else {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $stmt = mysqli_prepare($link, "INSERT INTO categoria (categoria) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $nome);
        mysqli_stmt_execute($stmt);
        header("Location: /sistema/vend/categoria/");
        exit;
    }
}

include("../../layout/header.php");
include("../menu.php");
?>

<br><br>Adicionar uma categoria<br><br>

<?php if (isset($erro)) echo "<span style=\"color:red; font-style: italic;\">" . htmlspecialchars($erro, ENT_QUOTES, "UTF-8") . "</span>"; ?>

<form method="post">
    <table>
        <tr>
            <td>Categoria:</td>
            <td><input type="text" name="categoria" value="<?=htmlspecialchars($nome ?? "", ENT_QUOTES, "UTF-8");?>"></td>
        </tr>
        <tr><td></td><td><input type="submit" value="Adicionar"></td></tr>
    </table>
</form>

<?php include("../../layout/footer.php"); ?>
