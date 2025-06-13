<?php
include 'konekcija.php';
define('UPLPATH', 'images/');

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    echo "ID članka ne postoji u bazi podataka!";
    exit;
}

$query = "SELECT * FROM vijesti WHERE id = $id";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Članak sa ID-em " . $id . " nije pronađen.";
    exit;
}

$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Projektni zadatak iz kolegija Programiranje web aplikacija">
		<meta name="keywords" content="Projekt, PWA, programiranje">
		<meta name="author" content="Mateo Spevec">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Članak</title>
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
            <article class="clanak">
                <h1 style="font-size: 40px;"><?php echo $row['naslov']; ?></h1>
                <img src="<?php echo UPLPATH . $row['slika']; ?>" alt="Slika">
                <h4 style="font-size: 20px;"><?php echo $row['sazetak'] ?></h4>
                <p style="font-size:17px;"><?php echo nl2br($row['tekst']); ?></p>
            </article>
        </main>
        
        <footer>
            <div id="footerDiv">
                <p>Mateo Spevec 2025. &copy;</p>
                <p>mspevec@tvz.hr</p>
            </div>
        </footer>
    </body> 
</html>