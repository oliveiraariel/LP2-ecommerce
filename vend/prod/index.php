<?php
include("../config.inc.php");
include("../session.php");
validaSessao();
include("../../layout/header.php");
include("../menu.php")
?>

<br><br>PRODUTOS<br><br>

<a href="/sistema/vend/prod/add.php"><input type="button" value="+ Adicionar"></a>

<?php
    $link = mysqli_connect("localhost", "root", "", "sistema");
    $sql = "SELECT * FROM prod ORDER BY nome"; 
    $result = mysqli_query($link, $sql); 
    echo "<br><br>";
    echo "<table border='1px'>";
        echo "<tr>";
            echo "<th>";
                echo "Nome";
            echo "</th>";
            echo "<th>";
                echo "Preço";
            echo "<th>";
                echo "Editar";
            echo "</th>";
            echo "<th>";
                echo "Apagar";
            echo "</th>";
        echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td>
                <?=$row["nome"];?>
            </td>
            <td>
                <?=$row["preco"];?>
            </td>
            <td>
                <a href="/sistema/vend/prod/upd.php?id=<?= $row["id"];?>"
                style="color:black;"> Editar</a>
            </td>
            <td>
                <a href="/sistema/vend/prod/del.php?id=<?= $row["id"];?>"
                style="color:black;"> Apagar</a>
            </td>
            <?php
    }
echo "</table>";
?>


<?php
include("../../layout/footer.php");
?>