<?php
include("./config.inc.php");
include("../layout/header.php");
?>

<?php
if (isset($_GET["a"])) {
    if (isset($_COOKIE["carrinho"])) {
        if (strpos($_COOKIE["carrinho"], "'" . $_GET["a"] . "'") === false) {
            setcookie(
                "carrinho",
                $_COOKIE["carrinho"] . ",'" . $_GET["a"] . "'",
                time() + 60 * 60 * 24 * 30
            );
        }
    } else {
        setcookie("carrinho", "'" . $_GET["a"] . "'", time() + 60 * 60 * 24 * 30);
    }
    header("Location: ./carrinho.php");
    exit;
} elseif (isset($_GET["r"])) {
    if (isset($_COOKIE["carrinho"])) {
        if (strpos($_COOKIE["carrinho"], "'" . $_GET["r"] . "'") !== false) {
            $carrinho = $_COOKIE["carrinho"];
            $carrinho = str_replace(",'" . $_GET["r"] . "',", ",", $carrinho);
            $carrinho = str_replace("'" . $_GET["r"] . "',", "", $carrinho);
            $carrinho = str_replace(",'" . $_GET["r"] . "'", "", $carrinho);
            $carrinho = str_replace("'" . $_GET["r"] . "'", "", $carrinho);
            setcookie("carrinho", $carrinho, time() + 60 * 60 * 24 * 30);
        }
    }
    header("Location: ./carrinho.php");
    exit;
}
?>

<html>

<head>
    <title>Carrinho</title>
</head>

<body>
    <a href="./index.php">Index</a><br><br>

    <?php
    if (isset($_COOKIE["carrinho"])) {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $sql = "SELECT * FROM prod WHERE 
    id IN (" . $_COOKIE["carrinho"] . ") ORDER BY nome";
        $result = mysqli_query($link, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row["nome"] . " " . $row["preco"] . " <a href=\"./carrinho.php?r=" . $row["id"] . "\"> 
   REMOVA 
  </a><br>";
            }
        }
    } else {
        echo "Sem carrinho!<br>";
    }
    ?>

    <br><a href="./index.php">Index</a>
</body>

</html>

<?php
include("../layout/footer.php");
?>