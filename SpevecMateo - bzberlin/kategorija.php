<?php
    $kategorija = $_GET['kategorija'] ?? '';
    $klasa = ($kategorija === 'sport') ? 'prvaKategorija' : 'drugaKategorija';
    $naslov = ($kategorija === 'sport') ? 'Sport' : 'Kultura i događaji';
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Projektni zadatak iz kolegija Programiranje web aplikacija">
		<meta name="keywords" content="Projekt, PWA, programiranje">
		<meta name="author" content="Mateo Spevec">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $naslov ?></title>
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
            <?php include 'konekcija.php'; 
            define('UPLPATH', 'images/'); 
            ?>


            <section>
                <?php 
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija' ORDER BY id DESC";
                $result = mysqli_query($dbc, $query);

                echo "<h1 id=\"$klasa\">$naslov</h1>";
                echo '<div class="artikli">';
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<img src="' . UPLPATH . $row['slika'] . '">'; 
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