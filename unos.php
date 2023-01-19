<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Unos zaposlenog</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php">BeeIT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="trazi.php">Pronadji zaposlenog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="unos.php">Unos zaposlenog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="obrisi.php">Brisanje zaposlenog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="azuriraj.php">Ažuriraj</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="transakcije.php">Transakcije</a>
        </li>
        </ul>
    </div>
    </nav>

    <form action="" method="POST">
        <label for="prezime">
            <span>Prezime:</span>
            <input type="text" name="prezime">
        </label>
        <label for="ime">
            <span>Ime:</span>
            <input type="text" name="ime">
        </label>
        <label for="pozicija">
            <span>Pozicija:</span>
            <input type="text" name="pozicija">
        </label>
        <input type="submit" value="Unesi" name="unesi">
    </form>
    
    <?php
    //PDO EKSTENZIJA
    try{
        $pdo=new PDO("mysql:host=localhost; dbname=beeit", "root","");
        echo "Konekcija je uspesna.";

        $sql="INSERT INTO zaposleni(prezime,ime,pozicija) VALUES(:prezime, :ime, :pozicija)";
        $stmt=$pdo->prepare($sql);

        $stmt->bindParam(":prezime",$prezime);
        $stmt->bindParam(":ime",$ime);
        $stmt->bindParam(":pozicija",$pozicija);

        if(isset($_POST['unesi'])){
            $prezime=$_POST['prezime'];
            $ime=$_POST['ime'];
            $pozicija=$_POST['pozicija'];

            if($prezime!="" && $ime!="" && $pozicija!=""){
                if(strlen($prezime)<5){
                    echo "<br>Prezime mora sadrzati minimum 5 karaktera";
                }
                elseif(strlen($ime)<3){
                    echo "<br>Ime mora sadrzati minimum 3 karaktera.";
                }
                else{
                    $stmt->execute();
                    echo "<br>Zaposleni uspesno unet u bazu.";
                }
            }
            else{
                echo "<br>Sva polja moraju biti popunjena!";
            }
        }
        

        //PROCEDURA BEZ PARAMETARA
        $sql1="DROP PROCEDURE IF EXISTS spisak_zaposlenih";
        $sql2="CREATE PROCEDURE spisak_zaposlenih()
        BEGIN 
            SELECT * FROM zaposleni WHERE pozicija='Web developer'; 
        END;";

        $pdo->exec($sql1);
        $pdo->exec($sql2);
        echo "<br>Procedura uspesno kreirana.<br>";
        echo "Radnici na poziciji Web developera:<br>";

        $sql="CALL spisak_zaposlenih()";
        $result=$pdo->query($sql);
        foreach($result as $row){
            echo $row['id']." ".$row['prezime']." ".$row['ime']." ".$row['pozicija']."<br>";
        }
        $stmt->closeCursor();
        echo "<hr>";

        //PROCEDURA SA PARAMETRIMA
        $sql1="DROP PROCEDURE IF EXISTS get_prezime";
        $sql2="CREATE PROCEDURE get_prezime(
            in id_z INT(11),
            out prezimeZ VARCHAR(30)
        )
        BEGIN
        SELECT prezime into prezimeZ FROM zaposleni WHERE id=id_z;
        END;";

        $pdo->exec($sql1);
        $pdo->exec($sql2);
        echo "Procedura uspesno kreirana.<br>";

        $sql="CALL get_prezime(:id, @prezimeZ)";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":id",$id);
        $id=2;
        $stmt->execute();

        $result=$pdo->query("SELECT @prezimeZ as prezimeZ");
        foreach($result as $row){
            echo $row['prezimeZ'];
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    ?>

</body>
</html>