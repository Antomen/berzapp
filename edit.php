<!DOCTYPE>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include "db.php";

        $sql = "SELECT * FROM nyhet WHERE id='" . $_GET["id"] . "'";
        $stmt = $dbm->prepare($sql);
        $stmt->bindParam(":flode", $flode);
        $stmt->execute();
        $infos = $stmt->fetchAll();
        echo "infos:";
        var_dump($infos);
        echo "<br>";
        echo "get";

        var_dump($_GET);

        foreach ($infos as $info) {
            echo $info["rubrik"] . "<br>";
            echo $info["flode"] . "<br>";
            echo $info["tid"] . "<br>";
//            echo $info["filnamn"] . "<br>";
//                header("Location: index.php");
            echo "<form method='GET'>";
            echo "<input type='hidden' value='" . $info["id"] . "' name='id'>";
            echo "</form>";
        }

        echo "<form method='GET' action='editsave.php'>";
        echo "<input type='hidden' value='" . $info['id'] . "' name='id'>";
        echo "<input type='text' placeholder='rubrik' name='rubrik' value='" . $info['rubrik'] . "'";
        echo "<br><br>";
        echo "<textarea name='flode'required>" . $info['flode'] . "</textarea>";
        echo "<br>";
        echo "<input type='submit' name='action' value='Save'>";
        echo "</form>";

        echo "<a href='index.php'>Uppdatera Resultat</a>";
        ?>
        
        <form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
            <input name="FileInput" id="FileInput" type="file" />
            <input type="submit"  id="submit-btn" value="Upload" />
            <img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>

        </form>
        <div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>

        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.form.min.js"></script>
        <script src="uploadfile.js"></script>
    </body>
</html>