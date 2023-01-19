<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>BeeIT</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">BeeIT</a>
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
            <a class="nav-link" href="azuriraj.php">Ažuriraj</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="transakcije.php">Transakcije</a>
        </li>
        </ul>
    </div>
    </nav>

    <h3>Promenite poziciju zaposlenog</h3>
    <form action="" method="POST">
        <label for="ime">
            <span>Ime:</span>
            <input type="text" name="ime">
        </label>
        <label for="prezime">
            <span>Prezime:</span>
            <input type="text" name="prezime">
        </label>
        <label for="pozicija">
            <span>Nova pozicija:</span>
            <input type="text" name="pozicija">
        </label>
        <input type="submit" value="Ažuriraj" name="azuriraj">
    </form>

    <?php
    //PDO EKSTENZIJA
    try{
        $pdo=new PDO("mysql:host=localhost; dbname=beeit", "root","");
        echo "Konekcija je uspesna.";

        $sql = "UPDATE zaposleni SET pozicija=:pozicija WHERE prezime=:prezime AND ime=:ime";

        $stmt=$pdo->prepare($sql);

        $stmt->bindParam(":ime",$ime);
        $stmt->bindParam(":prezime",$prezime);
        $stmt->bindParam(":pozicija",$pozicija);

        if(isset($_POST['azuriraj'])){
            $ime=$_POST['ime'];
            $prezime=$_POST['prezime'];
            $pozicija=$_POST['pozicija'];

            if($ime!="" && $prezime!="" && $pozicija!=""){
                $stmt->execute();
                echo "<br>Pozicija zaposlenog uspesno azurirana.";
            }
            else{
                echo "<br>Sva polja moraju biti popunjena!";
            }
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    ?>

</body>
</html>