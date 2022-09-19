<?php
session_start();
if (!isset($_SESSION['client'])) {
    header("./index.php");
} else {
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <?php if ($_SESSION['client'] != 0) { ?>
        <h1> Hello </h1>
        <h2> <?= $_SESSION['name'] ?></h2>
        <a href="logout.php">Logout</a>
    <?php } else {
        echo "only logged in users can see this!";
    } ?>
</body>

</html>