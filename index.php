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

    <form action="" method="POST">
        <label>
            <span>Izlistaj sve zaposlene:</span>
        </label>
        <input type="submit" value="Izlistaj" name="izlistaj">
    </form>
    
    <?php
    //MYSQLI EKSTENZIJA
    $mysqli=new mysqli("localhost","root","","beeit");
    if($mysqli->connect_errno){
        echo "Greska pri konekciji";
        exit();
    }
    echo "Uspesna konekcija.<br>";

    $sql="SELECT * FROM zaposleni";
    if(isset($_POST['izlistaj'])){ //klik na dugme
        $result=$mysqli->query($sql);
        while($row=$result->fetch_assoc()){ //fetch_assoc metoda vraca asocijativni niz podataka kao jedan red iz baze i smesta ga u promenljivu $row
            echo $row['id']." ".$row['prezime']." ".$row['ime']."-".$row['pozicija']."<br>";
        }
        echo "<hr>";
    }
    ?>
</body>
</html>