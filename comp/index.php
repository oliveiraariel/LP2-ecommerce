<?php
include("./config.inc.php");
include("../layout/header.php");
$link = mysqli_connect("localhost", "root", "", "sistema");
?>

Produtos
<br><br>

<form>
    <input type="text" name="kw" value="<?=htmlspecialchars($_GET["kw"] ?? "", ENT_QUOTES, "UTF-8");?>">
    <select name="categoria_id">
        <option value="">Todas as categorias</option>
        <?php
        $categorias = mysqli_query($link, "SELECT categoria_id, categoria FROM categoria ORDER BY categoria");
        while ($categoria = mysqli_fetch_assoc($categorias)) {
            $categoriaId = (int) $categoria["categoria_id"];
            $selected = (isset($_GET["categoria_id"]) && (int) $_GET["categoria_id"] === $categoriaId) ? " selected" : "";
            echo "<option value=\"$categoriaId\"$selected>" . htmlspecialchars($categoria["categoria"], ENT_QUOTES, "UTF-8") . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Buscar">
</form>
<br><br>


<?php
    $sql = "SELECT prod.id, prod.nome, prod.preco, categoria.categoria
            FROM prod
            LEFT JOIN categoria ON prod.categoria_id = categoria.categoria_id";
    $conditions = [];
    $types = "";
    $params = [];
    $kw = trim($_GET["kw"] ?? "");
    $categoriaId = filter_input(INPUT_GET, "categoria_id", FILTER_VALIDATE_INT);
    if ($kw !== "") {
        $conditions[] = "prod.nome LIKE ?";
        $types .= "s";
        $params[] = "%$kw%";
    }
    if ($categoriaId !== false && $categoriaId !== null) {
        $conditions[] = "categoria.categoria_id = ?";
        $types .= "i";
        $params[] = $categoriaId;
    }
    if ($conditions) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
    $sql .= " ORDER BY prod.nome";
    $stmt = mysqli_prepare($link, $sql);
    if ($params) {
        $bindParams = [$stmt, $types];
        foreach ($params as $key => &$value) {
            $bindParams[] = &$value;
        }
        call_user_func_array("mysqli_stmt_bind_param", $bindParams);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
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
             <th>
                 Categoria
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
                <?=htmlspecialchars($row["nome"], ENT_QUOTES, "UTF-8");?>
            </td>
            <td>
                <?=htmlspecialchars($row["preco"], ENT_QUOTES, "UTF-8");?>
            </td>
            <td>
                <?=htmlspecialchars($row["categoria"] ?? "Sem categoria", ENT_QUOTES, "UTF-8");?>
            </td>
            <?php
    }
    ?>
</table>

<?php
include("../layout/footer.php");
?>
