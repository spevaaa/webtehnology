<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'konekcija.php';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $picture = $_FILES['photo']['name'];
        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $date = date('d.m.Y.');

        $archive = isset($_POST['archive']) ? 1 : 0;

        $query = "INSERT INTO Vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) 
                  VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

        $result = mysqli_query($dbc, $query) or die('Greška kod upisa u bazu.');
        mysqli_close($dbc);
    } else {
        echo "<p>Greška kod učitavanja slike.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Projektni zadatak iz kolegija Programiranje web aplikacija">
		<meta name="keywords" content="Projekt, PWA, programiranje">
		<meta name="author" content="Mateo Spevec">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prikaz unesene vijesti</title>
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
                <h1 class="title">
                <?php
                if (isset($_POST['title'])) {
                    $title = $_POST['title'];
                    echo $title;
                }
                ?>
                </h1>

                    <?php
                        $photo = $_FILES['photo']['name'];
                        $target_dir = "images/";
                        $target_file = $target_dir . basename($photo);
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
                        echo "<img src='images/$photo' alt='Slika' />";
                    ?>

                   <p> <?php
                   if(isset($_POST['about'])){
                            $about = $_POST['about'];
                            echo "<h4>" . $about . "</h4>";
                        }
                        ?> 
                    </p>
                   <p> 
                    <?php
                    if(isset($_POST['content'])){
                            $content = $_POST['content'];
                            echo nl2br($content);
                        }
                      ?>
                 </p>
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