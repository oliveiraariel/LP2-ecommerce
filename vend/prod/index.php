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
    $sql = "SELECT prod.nome, prod.preco, prod.id, categoria.categoria
            FROM prod
            LEFT JOIN categoria ON prod.categoria_id = categoria.categoria_id
            ORDER BY prod.nome";
    $result = mysqli_query($link, $sql); 
    echo "<br><br>";
    echo "<table border='1px'>";
        echo "<tr>";
            echo "<th>";
                echo "Nome";
            echo "</th>";
            echo "<th>Categoria</th>";
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
                <?=htmlspecialchars($row["nome"], ENT_QUOTES, "UTF-8");?>
            </td>
            <td>
                <?=htmlspecialchars($row["categoria"] ?? "Sem categoria", ENT_QUOTES, "UTF-8");?>
            </td>
            <td>
                <?=htmlspecialchars($row["preco"], ENT_QUOTES, "UTF-8");?>
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
