<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Projektni zadatak iz kolegija Programiranje web aplikacija">
		<meta name="keywords" content="Projekt, PWA, programiranje">
		<meta name="author" content="Mateo Spevec">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Unos vijesti</title>
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
            <h2>Unos vijesti:</h2>
            <form action="skripta.php" method="POST" enctype="multipart/form-data">
                <div class="stavka">
                    <label for="title">Naslov vijesti</label>
                    <div class="polje">
                        <input type="text" name="title" class="form-field-textual">
                    </div>
                </div>
                
                <div class="stavka">
                    <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                    <div class="polje">
                        <textarea name="about" id="about" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>
                
                <div class="stavka">
                    <label for="content">Sadržaj vijesti</label>
                    <div class="form-field">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>
                <div class="stavka">
                    <label for="photo">Slika: </label>
                    <div class="polje">
                        <input type="file" class="input-text" name="photo" accept="image/*"/>
                    </div>
                
                </div>
                <div class="stavka">
                    <label for="category">Kategorija vijesti</label>
                    <div class="polje">
                        <select name="category" id="" class="form-field-textual">
                            <option value="Sport">Sport</option>
                            <option value="Kultura">Kultura</option>
                        </select>
                    </div>
                </div>
                
                <div class="stavka">
                    <label>Spremiti u arhivu:
                        <div class="polje">
                            <input type="checkbox" name="archive" id="archive">
                        </div>
                    </label>
                </div>
                
                <div class="stavka">
                    <button type="reset" value="Poništi">Poništi</button>
                    <button type="submit" value="Prihvati">Prihvati</button>
                </div>
            </form>
        </main>
        
        <footer>
            <div id="footerDiv">
                <p>Mateo Spevec 2025. &copy;</p>
                <p>mspevec@tvz.hr</p>
            </div>
        </footer>
    </body> 
</html>