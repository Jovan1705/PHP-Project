<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Brisanje zaposlenog</title>
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
            <a class="nav-link" href="#">Brisanje zaposlenog</a>
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
        <label for="brInd">
            <span>Prezime zaposlenog:</span>
            <input type="text" name="prezime">
        </label>
        <input type="submit" value="Obrisi" name="obrisi">
    </form>
    
    <?php
    //MYSQLI EKSTENZIJA
    $mysqli=new mysqli("localhost","root","","beeit");
    if($mysqli->connect_errno){
        echo "Greska pri konekciji";
        exit();
    }
    echo "Uspesna konekcija.<br>";

    $sql="DELETE FROM zaposleni WHERE prezime=?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param("s",$prezime);

    if(isset($_POST['obrisi'])){ //klik na dugme

        $prezime=$_POST['prezime']; //uzimamo podatak iz input polja

        if($prezime!=""){
            if($stmt->execute()){
                echo "Student je uspesno obrisan";
            }
            else{
                echo "Greska pri brisanju.";
            }
        }
        else{
            echo "Morate uneti prezime zaposlenog!";
        }
    }
    ?>

</body>
</html>