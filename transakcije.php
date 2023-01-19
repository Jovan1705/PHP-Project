<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>BeeIT</title>
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
            <a class="nav-link" href="azuriraj.php">Ažuriraj</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="transakcije.php">Transakcije</a>
        </li>
        </ul>
    </div>
    </nav>

    <?php
    try{
        $pdo=new PDO("mysql:host=localhost; dbname=beeit", "root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->beginTransaction();

        $sql = "SELECT ime, prezime FROM zaposleni WHERE pozicija = :pozicija";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":pozicija", $pozicija);
        $pozicija = "CEO";
        $stmt->execute();
        $result = $stmt->fetchAll();

        echo "Zaposleni na poziciji CEO u nasoj kompaniji:<br>";
        foreach($result as $row){
            echo $row['ime']." ".$row['prezime']."<br>";
        }

        $pdo->commit();
    }
    catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
    }
    ?>

</body>
</html>