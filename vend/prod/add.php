<?php
include("../config.inc.php");
include("../session.php");
validaSessao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (!$nome){
        $erro = "Nome Vazio";
    }else if(!$preco){
        $erro = "Preco Vazio";
    }else{
        $link = mysqli_connect("localhost", "root", "", "sistema"); 
        $sql = "INSERT INTO prod (nome, preco) VALUES ('"
               .$nome.
               "','"
               .$preco.
               "')";
        $result = mysqli_query($link, $sql); 
        header("Location: /sistema/vend/prod/");
        exit;
    }
}


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
            <td><input type="text" name="nome" value="<?=isset($nome)?$nome:"";?>">
            </td>
        </tr>
            <td>Preço:</td>
            <td><input type="text" name="preco" value="<?=isset($preco)?$preco:"";?>">
            </td>
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