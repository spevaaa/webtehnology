<?php
include 'konekcija.php';

$registriranKorisnik = false;
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $username = trim($_POST['username']);
    $lozinka = $_POST['pass'];
    $ponovljenaLozinka = $_POST['passRep'];
    $razina = 0;

    if (empty($ime) || empty($prezime) || empty($username) || empty($lozinka) || $lozinka !== $ponovljenaLozinka) {
        $msg = "Svi podaci su obavezni i lozinke moraju biti iste!";
    } else {
        $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);

        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $msg = 'Korisničko ime već postoji!';
                echo "<script>alert(" . json_encode($msg) . ");</script>";
            } else {
                $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($dbc);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $username, $hashed_password, $razina);
                    mysqli_stmt_execute($stmt);
                    $registriranKorisnik = true;
                }
            }
        }
    }

    mysqli_close($dbc);
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
    <title>Registracija korisnika</title>
    <style>
        #forma{ width: 55%; }
        .bojaPoruke { color: red; font-weight: bold; }
        .form-item { margin-bottom: 15px; }
        .form-field-textual { width: 100%; padding: 5px; }
    </style>
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

    <?php if ($registriranKorisnik): ?>
        <section class="reg">
            <p style="color: green; font-weight: bold;">Korisnik je uspješno registriran!</p>
            <br><br>
            <a href="administracija.php"><button type="button">Natrag na prijavu</button></a>
        </section>
    <?php else: ?>
       <form action="" method="POST" id="forma">
    <div class="form-item">
        <span id="porukaIme" class="bojaPoruke"></span>
        <label for="ime">Ime:</label>
        <div class="form-field">
            <input type="text" name="ime" id="ime" class="form-field-textual" required>
        </div>
    </div>

    <div class="form-item">
        <span id="porukaPrezime" class="bojaPoruke"></span>
        <label for="prezime">Prezime:</label>
        <div class="form-field">
            <input type="text" name="prezime" id="prezime" class="form-field-textual" required>
        </div>
    </div>

    <div class="form-item">
        <span id="porukaUsername" class="bojaPoruke"></span>
        <label for="username">Korisničko ime:</label>
        <div class="form-field">
            <input type="text" name="username" id="username" class="form-field-textual" required>
        </div>
    </div>

    <div class="form-item">
        <span id="porukaPass" class="bojaPoruke"></span>
        <label for="pass">Lozinka:</label>
        <div class="form-field">
            <input type="password" name="pass" id="pass" class="form-field-textual" required>
        </div>
    </div>

    <div class="form-item">
        <span id="porukaPassRep" class="bojaPoruke"></span>
        <label for="passRep">Ponovite lozinku:</label>
        <div class="form-field">
            <input type="password" name="passRep" id="passRep" class="form-field-textual" required>
        </div>
    </div>

    <div class="form-item">
        <button type="submit" id="slanje" name="registracija">Registrirajte se</button>
    </div>
</form>

    <script>
    document.getElementById("slanje").onclick = function(event) {
        let slanjeForme = true;

        const ime = document.getElementById("ime");
        const prezime = document.getElementById("prezime");
        const username = document.getElementById("username");
        const pass = document.getElementById("pass");
        const passRep = document.getElementById("passRep");

        if (ime.value.trim() === "") {
            slanjeForme = false;
            ime.style.border = "1px dashed red";
            document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
        } else {
            ime.style.border = "1px solid green";
            document.getElementById("porukaIme").innerHTML = "";
        }

        if (prezime.value.trim() === "") {
            slanjeForme = false;
            prezime.style.border = "1px dashed red";
            document.getElementById("porukaPrezime").innerHTML = "<br>Unesite prezime!<br>";
        } else {
            prezime.style.border = "1px solid green";
            document.getElementById("porukaPrezime").innerHTML = "";
        }

        if (username.value.trim() === "") {
            slanjeForme = false;
            username.style.border = "1px dashed red";
            document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
        } else {
            username.style.border = "1px solid green";
            document.getElementById("porukaUsername").innerHTML = "";
        }

        if (pass.value === "" || passRep.value === "" || pass.value !== passRep.value) {
            slanjeForme = false;
            pass.style.border = "1px dashed red";
            passRep.style.border = "1px dashed red";
            document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste ili su prazne!<br>";
            document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste ili su prazne!<br>";
        } else {
            pass.style.border = "1px solid green";
            passRep.style.border = "1px solid green";
            document.getElementById("porukaPass").innerHTML = "";
            document.getElementById("porukaPassRep").innerHTML = "";
        }

        if (!slanjeForme) {
            event.preventDefault();
        }
    };
    </script>
    <?php endif; ?>

    <footer>
        <div id="footerDiv">
            <p>Mateo Spevec 2025. &copy;</p>
            <p>mspevec@tvz.hr</p>
        </div>
    </footer>
</body>
</html>
