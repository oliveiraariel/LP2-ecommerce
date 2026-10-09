<?php
include("./config.inc.php");
include("./session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (contaValida($_POST["username"], $_POST["password"])) { 
        registraConta($_POST["username"]); 
        header("Location: ./index.php"); 
        exit; 
    }
    $username = $_POST["username"]; 
    $mensagem = "Username ou Password incorreto!"; 
} 

include("../layout/header.php");

?>

<form name="formLogin" method="POST"> 
    <table> 
        <tr> 
            <td colspan="2"> 
    <?=isset($mensagem)?$mensagem:"";?> 
            </td> 
        </tr> 
        <tr> 
            <td>Username:</td> 
            <td> 
    <input type="text" name="username" 
        value="<?=isset($username)?$username:"";?>"> 
            </td> 
        </tr> 
        <tr> 
            <td>Password:</td> 
            <td> 
    <input type="password" name="password" 
        value="<?=isset($password)?$password:"";?>"> 
            </td> 
        </tr> 
        <tr> 
            <td colspan="2"> 
    <input type="submit" name="submit" value="Submit"> 
            </td>
        </tr> 
    </table> 
</form> 
<script language="JavaScript" type="text/javascript"> 
    <!-- 
    if (document.formLogin.username.value) { 
        document.formLogin.password.focus(); 
    } else { 
        document.formLogin.username.focus(); 
    } 
    //--> 
</script> 

    SEJA BEM VINDO!
    
    <?php
    include("../layout/footer.php");
    ?>