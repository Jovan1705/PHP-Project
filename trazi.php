<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pronadji zaposlenog</title>
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
            <a class="nav-link" href="#">Pronadji zaposlenog</a>
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
        <label for="brInd">
            <span>ID zaposlenog:</span>
            <input type="text" name="id">
        </label>
        <input type="submit" value="Pronadji" name="pronadji">
    </form>
    
    <?php
    //MYSQLI EKSTENZIJA
    $mysqli=new mysqli("localhost","root","","beeit");
    if($mysqli->connect_errno){
        echo "Greska pri konekciji";
        exit();
    }
    echo "Uspesna konekcija.<br>";

    $sql="SELECT * FROM zaposleni WHERE id=?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param("s",$id);

    if(isset($_POST['pronadji'])){ //klik na dugme

        $id=$_POST['id']; //uzimamo podatak iz input polja

        if($id!=""){
            $stmt->execute();
            $result=$stmt->get_result();
            $row=$result->fetch_assoc();
            if($mysqli->affected_rows>0){ //proverava da li je vracen red iz tabele
                echo $row['id']." ".$row['prezime']." ".$row['ime']." ".$row['pozicija'];
            }
            else{
                echo "Ne postoji zaposleni sa unetim ID-em!<br>";
            }

            if (filter_var($id,FILTER_VALIDATE_INT) != TRUE) {
                echo "Molimo da unesete samo brojeve u polje za pretragu.<br>";
              }
        }
        else{
            echo "Morate uneti ID zaposlenog!";
        }
    }

    class Zaposleni{
        public $ime;
        public $prezime;
        function unos($ime,$prezime){
            $this->ime=$ime;
            $this->prezime=$prezime;
        }
        function ispis(){
            return $this->ime." ".$this->prezime;
        }
    }

    class Pozicija extends Zaposleni{
        public $pozicija;
        function unosp($pozicija){
            $this->pozicija=$pozicija;
        }
        function ispisPozicije(){
            return $this->ime." ".$this->prezime."-".$this->pozicija;
        }
    }

    echo "<hr>";

    $radnik=new Zaposleni();
    $radnik->unos("Nikola","Djuka");
    echo $radnik->ispis();
    echo "<br>";

    $radnik2=new Pozicija();
    $radnik2->unos("Marko","Sovic");
    $radnik2->unosp("Asistent");
    echo $radnik2->ispisPozicije();

    ?>

</body>
</html>