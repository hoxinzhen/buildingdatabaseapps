<?php
    require_once "pdo.php";
    if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
        die('Name parameter missing');
    }

    if ( isset($_POST['logout']) ) {
        header('Location: index.php');
        return;
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Ho Xin Zhen - Automobile Tracker</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
            if ( isset($_REQUEST['name']) ) {
                echo "<h1>Tracking Autos for ";
                echo htmlentities($_REQUEST['name']);
                echo "</h1>\n";
            }

            if ( isset($_POST['make']) && isset($_POST['year'])&& isset($_POST['mileage'])) {
                if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
                    echo("<p class='fail'> Mileage and year must be numeric</p>");
                }elseif(strlen($_POST['make'])<1){
                    echo("<p class='fail'>Make is required</p>");
                } else{
                    $stmt = $pdo->prepare('INSERT INTO autos
                    (make, year, mileage) VALUES ( :mk, :yr, :mi)');
                    $stmt->execute(array(
                    ':mk' => $_POST['make'],
                    ':yr' => $_POST['year'],
                    ':mi' => $_POST['mileage']));
                    echo("<p class='success'>Record inserted</p>");
                }
            }
        ?>
        
        <form method="post">
            <p>Make:
            <input type="text" name="make" size="60"/></p>
            <p>Year:
            <input type="text" name="year"/></p>
            <p>Mileage:
            <input type="text" name="mileage"/></p>
            <input type="submit" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>

        <h2>Automobiles</h2>
        <table border="1">
            <?php
            $stmt = $pdo->query("SELECT make, year, mileage FROM autos");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ( $rows as $row ) {
                echo "<tr><td>";
                echo(htmlentities($row['make']));
                echo("</td><td>");
                echo(htmlentities($row['year']));
                echo("</td><td>");
                echo(htmlentities($row['mileage']));
                echo("</td></tr>\n");
            }
            ?>
        </table>

    </div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
