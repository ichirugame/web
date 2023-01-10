<?php
if(isset($_COOKIE['memo'])){
    setcookie("memo", null, time() - 30);
    echo "削除できました。";
?>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script>
setTimeout("redirect()", 1750);
function redirect(){
    location.href="./index.php";
}
</script>
<?php
}elseif(empty($_COOKIE['memo'])){
    echo "削除されています。";
?>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script>
setTimeout("redirect()", 1750);
function redirect(){
    location.href="./index.php";
}
</script>
<?php
}else{
    header('Location: ./index.php');
    exit;
}
?>
