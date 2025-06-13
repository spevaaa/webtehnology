<?php
    include 'konekcija.php';
    define('UPLPATH', 'images/');

    $querySport = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Sport' ORDER BY id DESC LIMIT 3";
    $queryKultura = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Kultura' ORDER BY id DESC LIMIT 3";

    $resultSport = mysqli_query($dbc, $querySport) or die('Greška kod čitanja vijesti iz sporta iz baze.');
    $resultKultura = mysqli_query($dbc, $queryKultura) or die('Greška kod čitanja vijesti iz kulture iz baze.');
    mysqli_close($dbc);
?>


<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Projektni zadatak iz kolegija Programiranje web aplikacija">
		<meta name="keywords" content="Projekt, PWA, programiranje">
		<meta name="author" content="Mateo Spevec">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Početna</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="crveni"></div>
        <header>
            <img src="images/BZ_logo.svg" alt="Logo" id="logo">
            <nav>
                <ul>
                    <li><a href="index.php">POČETNA</a></li>
                    <li><a href="kategorija.php?kategorija=sport">SPORT</a></li>
                    <li><a href="kategorija.php?kategorija=kultura">KULTURA I DOGAĐAJI</a></li>
                    <li><a href="unos.php">UNOS VIJESTI</a></li>
                    <li><a href="administracija.php">ADMINISTRACIJA</a></li>
                </ul>
            </nav>
        </header>
        
        <main>
            <section>
                <h1 id="prvaKategorija"><a href="kategorija.php?kategorija=sport">Sport ></a></h1>

                <?php
                    echo '<div class="artikli">';
                    while($row = mysqli_fetch_array($resultSport)) {
                        echo '<article>';
                        echo '<img src="' . UPLPATH . $row['slika'] . '">'; 
                        echo '<h4 class="sportPodnaslov">' . $row['datum'] . '</h4>';
                        echo '<h2 class="title">';
                        echo '<a href="clanak.php?id='.$row['id'].'">'; 
                        echo $row['naslov'];
                        echo '</a></h2>';
                        echo '</article>';
                    }
                    echo '</div>';
                ?>
                
            </section>
            
            
            <section>
                <h1 id="drugaKategorija"><a href="kategorija.php?kategorija=kultura">Kultura i događaji ></a></h1>
                <?php
                    echo '<div class="artikli">';
                    while($row = mysqli_fetch_array($resultKultura)) {
                        echo '<article>';
                        echo '<img src="' . UPLPATH . $row['slika'] . '">'; 
                        echo '<h4 class="kulturaPodnaslov">' . $row['datum'] . '</h4>';
                        echo '<h2 class="title">';
                        echo '<a href="clanak.php?id='.$row['id'].'">'; 
                        echo $row['naslov'];
                        echo '</a></h2>';
                        echo '</article>';
                    }
                    echo '</div>';
                ?>
                
            </section>
        </main>
        
        <footer>
            <div id="footerDiv">
                <p>Mateo Spevec 2025. &copy;</p>
                <p>mspevec@tvz.hr</p>
            </div>
        </footer>
    </body> 
</html>