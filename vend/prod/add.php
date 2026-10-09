<?php
include("../config.inc.php");
include("../session.php");
validaSessao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $preco = trim($_POST["preco"] ?? "");
    $categoria_input = $_POST["categoria_id"] ?? "";
    $categoria_id = null;
    if ($categoria_input !== "") {
        $categoria_id = filter_var($categoria_input, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
        if ($categoria_id === false) {
            $erro = "Categoria inválida";
        }
    }
    if (!$nome){
        $erro = "Nome Vazio";
    }else if(!$preco){
        $erro = "Preco Vazio";
    }else{
        $link = mysqli_connect("localhost", "root", "", "sistema");
        if ($categoria_id !== null && $categoria_id !== false) {
            $stmt = mysqli_prepare($link, "SELECT categoria_id FROM categoria WHERE categoria_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $categoria_id);
            mysqli_stmt_execute($stmt);
            if (!mysqli_stmt_get_result($stmt)->fetch_assoc()) {
                $erro = "Categoria inválida";
            }
        }
        if (!isset($erro)) {
            $stmt = mysqli_prepare($link, "INSERT INTO prod (nome, preco, categoria_id) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sdi", $nome, $preco, $categoria_id);
            mysqli_stmt_execute($stmt);
            header("Location: /sistema/vend/prod/");
            exit;
        }
    }
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$categorias = mysqli_query($link, "SELECT categoria_id, categoria FROM categoria ORDER BY categoria");


include("../../layout/header.php");
include("../menu.php")
?>

<br><br>Adicionar um produto<br><br>

<?php
if(isset($erro)){
    echo "<span style=\"color:red; font-style: italic;\">";
    echo $erro;
    echo "</span>";
}
?>

<form method="post">
    <table>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="nome" value="<?=htmlspecialchars($nome ?? "", ENT_QUOTES, "UTF-8");?>">
            </td>
        </tr>
            <td>Preço:</td>
            <td><input type="text" name="preco" value="<?=htmlspecialchars($preco ?? "", ENT_QUOTES, "UTF-8");?>">
            </td>
        <tr>
            <td>Categoria:</td>
            <td>
                <select name="categoria_id">
                    <option value="">Sem categoria</option>
                    <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
                        <option value="<?=$categoria["categoria_id"];?>" <?=((string)($categoria_id ?? "") === (string)$categoria["categoria_id"]) ? "selected" : "";?>><?=htmlspecialchars($categoria["categoria"], ENT_QUOTES, "UTF-8");?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Adicionar">
            </td>
        </tr>
        <tr>
            
        </tr>
    </table>
</form>

<?php
include("../../layout/footer.php");
?>
