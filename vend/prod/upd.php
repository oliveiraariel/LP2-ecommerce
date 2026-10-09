<?php
include("../config.inc.php");
include("../session.php");
validaSessao();

if (!isset($_GET["id"]) || !$_GET["id"]) {
    header("Location: /sistema/vend/prod/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$stmt = mysqli_prepare($link, "SELECT * FROM prod WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 0) {
    header("Location: /sistema/vend/prod/");
    exit;
}
$nome = $row["nome"];
$preco = $row["preco"];
$categoria_id = $row["categoria_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $preco = trim($_POST["preco"] ?? "");
    $categoria_id = filter_input(INPUT_POST, "categoria_id", FILTER_VALIDATE_INT);
    if (!$nome){
        $erro = "Nome Vazio";
    }else if(!$preco){
        $erro = "Preco Vazio";
    }else{
        if ($categoria_id !== null && $categoria_id !== false) {
            $stmt = mysqli_prepare($link, "SELECT categoria_id FROM categoria WHERE categoria_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $categoria_id);
            mysqli_stmt_execute($stmt);
            if (!mysqli_stmt_get_result($stmt)->fetch_assoc()) {
                $erro = "Categoria inválida";
            }
        }
        if (!isset($erro)) {
            $stmt = mysqli_prepare($link, "UPDATE prod SET nome = ?, preco = ?, categoria_id = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "sdii", $nome, $preco, $categoria_id, $id);
            mysqli_stmt_execute($stmt);
            header("Location: /sistema/vend/prod/");
            exit;
        }
    }
}

$categorias = mysqli_query($link, "SELECT categoria_id, categoria FROM categoria ORDER BY categoria");


include("../../layout/header.php");
include("../menu.php")
?>

<br><br> Editar Produto <br><br>

<?php
if(isset($erro)){
    echo "<span style=\"color:red; font-style: italic;\">";
    echo $erro;
    echo "</span>";
}
?>

<form method="post">
    <input type="hidden" name="id" value="<?=isset($id) ?$id:"";?>">
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
            <td><input type="submit" value="Editar">
            </td>
        </tr>
        <tr>
            
        </tr>
    </table>
</form>

<?php
include("../../layout/footer.php");
?>
