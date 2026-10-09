<?php
include("./config.inc.php");
include("../layout/header.php");
?>

Produtos
<br><br>

<form>  
    <input type="text" name="kw" value="<?= (isset($_GET["kw"]) && $_GET["kw"])?
    $_GET["kw"]:"";?>">
    <input type="submit" value="Buscar">
</form>
<br><br>


<?php
    $link = mysqli_connect("localhost", "root", "", "sistema");
    $sql = "SELECT * FROM prod"; 
    if(isset($_GET["kw"]) && $_GET["kw"]){
        $sql .= " WHERE nome LIKE '%".$_GET["kw"]."%'";
    }
    $sql .=" ORDER BY nome";
    $result = mysqli_query($link, $sql);    
?>

<a href="./carrinho.php" style="color:black;"> Meu carrinho </a><br><br>

</a>

<table border='1px'>
         <tr>
            <th>
                Carrinho
            </th>
             <th>
                 Nome
             </th>
             <th>
                 Preço
</th>
         </tr>
        <?php
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td align="center">
                <a href="./carrinho.php?a=<?=$row["id"];?>" style="color: black;"
                ><img src="/sistema/layout/carrinho.png"></a>                
            </td>
            <td>
                <?=$row["nome"];?>
            </td>
            <td>
                <?=$row["preco"];?>
            </td>
            <?php
    }
    ?>
</table>

<?php
include("../layout/footer.php");
?>