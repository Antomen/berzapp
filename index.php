<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include "db.php";


        $sql = "SELECT * FROM nyhet";
        $stmt = $dbm->prepare($sql);
        $stmt->bindParam(":flode", $flode);
        $stmt->execute();
        $infos = $stmt->fetchAll();

        $flode = filter_input(INPUT_GET, 'flode', FILTER_SANITIZE_SPECIAL_CHARS);

        foreach ($infos as $info) {
            echo $info["rubrik"] . "<br>";
            echo "<img src='img/" . $info["filnamn"] . "' alt='Corrupt File' width='100'>" . "<br>";
            echo $info["flode"] . "<br>";
            echo $info["tid"] . "<br>";
            echo "<form method='GET'>";
            echo "<input type='hidden' value='" . $info["id"] . "' name='id'>";
            echo "<input type='submit' name='action' value='delete'>";
            echo "</form>";
            echo "<form method='GET' action='edit.php'>";
            echo "<input type='hidden' value='" . $info["id"] . "' name='id'>";
            echo "<input type='submit' name='action' value='edit'>";
            echo "</form>";
        }

        if (isset($_GET["action"])) {

            if ($_GET["action"] == "delete") {
                $delete = "DELETE FROM nyhet WHERE id='" . $_GET["id"] . "'";
                $stmt = $dbm->prepare($delete);
                $stmt->execute();
                header("Location: index.php");
            }
        }
        echo "<br>" . "<a href='index.php'>Uppdatera Resultat</a>";
        echo "<br>" . "<a href='add.php'>Lägg till nyhet</a>";
        ?>
    </body>
</html>
