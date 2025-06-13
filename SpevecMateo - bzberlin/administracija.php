<?php
session_start();
include 'konekcija.php';
define('UPLPATH', 'images/');

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: administracija.php");
    exit();
}

$uspjesnaPrijava = false;
$admin = false;

if (isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);

        if (password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
            $uspjesnaPrijava = true;
            $admin = $levelKorisnika == 1;
            $_SESSION['username'] = $imeKorisnika;
            $_SESSION['level'] = $levelKorisnika;
        }else{
            $uspjesnaPrijava = false;
            echo "<script>alert('Korisnik nije pronađen!');</script>";
        }
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $naslov = $_POST['title'];
    $sazetak = $_POST['about'];
    $tekst = $_POST['content'];
    $kategorija = $_POST['category'];
    $arhiva = isset($_POST['archive']) ? 1 : 0;

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $slika = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], UPLPATH . $slika);
    } else {
        $querySlika = "SELECT slika FROM vijesti WHERE id = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $querySlika)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $resultSlika = mysqli_stmt_get_result($stmt);
            $rowSlika = mysqli_fetch_assoc($resultSlika);
            $slika = $rowSlika['slika'];
        }
    }

    $queryUpdate = "UPDATE vijesti SET naslov = ?, sazetak = ?, tekst = ?, kategorija = ?, arhiva = ?, slika = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $queryUpdate)) {
        mysqli_stmt_bind_param($stmt, 'ssssisi', $naslov, $sazetak, $tekst, $kategorija, $arhiva, $slika, $id);
        mysqli_stmt_execute($stmt);
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $queryDelete = "DELETE FROM vijesti WHERE id = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $queryDelete)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
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
    <title>Administracija</title>
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
    <?php
    if ((isset($uspjesnaPrijava) && $uspjesnaPrijava && $admin) || 
        (isset($_SESSION['username']) && $_SESSION['level'] == 1)) {

        $query = "SELECT * FROM vijesti";
        $result = mysqli_query($dbc, $query);

        while ($row = mysqli_fetch_array($result)) {
            echo '<form enctype="multipart/form-data" action="" method="POST">';
            echo '<div class="stavka">
                    <label>Naslov:</label>
                    <input type="text" name="title" value="' . $row['naslov'] . '">
                </div>';
            echo '<div class="stavka">
                    <label>Sazetak:</label>
                    <textarea name="about">' . $row['sazetak'] . '</textarea>
                </div>';
            echo '<div class="stavka">
                    <label>Tekst:</label>
                    <textarea name="content">' . $row['tekst'] . '</textarea>
                </div>';
            echo '<div class="stavka">
                    <label>Slika:</label>
                    <input type="file" name="photo"> <br><br>
                    <img src="' . UPLPATH . $row['slika'] . '" width="100px">
                </div>';
            echo '<div class="stavka">
                    <label>Kategorija:</label>
                    <select name="category">
                        <option value="sport"' . ($row['kategorija'] == 'sport' ? ' selected' : '') . '>Sport</option>
                        <option value="kultura"' . ($row['kategorija'] == 'kultura' ? ' selected' : '') . '>Kultura</option>
                    </select>
                </div>';
            echo '<div class="stavka">
                    <label>Arhiva:</label>
                    <input type="checkbox" name="archive"' . ($row['arhiva'] == 1 ? ' checked' : '') . '>
                </div>';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">
                <button type="submit" name="update">Izmijeni</button>
                <button type="submit" name="delete">Izbriši</button>';
            echo '</form>';  
        }
    } elseif (isset($uspjesnaPrijava) && $uspjesnaPrijava && !$admin) {
        echo '<p>Bok ' . htmlspecialchars($imeKorisnika) . ', ali niste administrator.</p>';
    } elseif (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
        echo '<p>Bok ' . htmlspecialchars($_SESSION['username']) . ', ali niste administrator.</p>';
    } else {
    ?>
        <h2>Prijava</h2>
        <form method="POST" action="">
            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" required>
            <br><br>
            <label for="lozinka">Lozinka:</label>
            <input type="password" name="lozinka" required>
            <br><br>
            <button type="submit" name="prijava">Prijavite se</button>
        </form><br>
        
        <form action="registracija.php" method="GET" style="margin-top: 10px;">
            <h3>Nemate račun?</h3>
            <button type="submit">Registrirajte se</button>
        </form>
    <?php } ?>

    <?php if (isset($_SESSION['username'])): ?>
    <form method="POST" class="logout-form">
        <button type="submit" name="logout">Odjava</button>
    </form>
    <?php endif; ?>
    </main>

    <footer>
        <div id="footerDiv">
            <p>Mateo Spevec 2025. &copy;</p>
            <p>mspevec@tvz.hr</p>
        </div>
    </footer>
</body>
</html>
