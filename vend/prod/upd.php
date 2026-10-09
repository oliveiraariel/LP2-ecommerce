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
extract($row);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (!$nome){
        $erro = "Nome Vazio";
    }else if(!$preco){
        $erro = "Preco Vazio";
    }else{
        $link = mysqli_connect("localhost", "root", "", "sistema"); 
        $sql = "UPDATE prod SET nome = '".$nome."', preco = '".$preco."' WHERE id = '".$id."';";
        $result = mysqli_query($link, $sql); 
        header("Location: /sistema/vend/prod/");
        exit;
    }
}


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
            <td><input type="text" name="nome" value="<?=isset($nome)?$nome:"";?>">
            </td>
        </tr>
            <td>Preço:</td>
            <td><input type="text" name="preco" value="<?=isset($preco)?$preco:"";?>">
            </td>
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