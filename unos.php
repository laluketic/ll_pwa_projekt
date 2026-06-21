<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Unos</title>
</head>
<body>
    <?php include 'HiF/header.php'; ?>

<main>
    <section class="sekcija_unos">
        <div class="wrapper">
            <div class="unos_container">
                <div class="section_naslov">
                    <h2>Unos vijesti</h2>
                    <hr>
                </div>

                <form class="unos_forma" action="skripta.php" method="post"  enctype="multipart/form-data"name="unos_vijesti">
                    
                    <div class="unos_red">
                        <label for="naslov">Naslov vijesti: </label>
                        <input type="text" name="naslov" id="naslov" class="unos_polje" required>
                    </div>

                    <div class="unos_red">
                        <label for="sazetak">Sažetak vijesti: </label>
                        <textarea name="sazetak" id="sazetak" class="unos_polje " rows="5" required></textarea>
                    </div>

                    <div class="unos_red">
                        <label for="tekst">Tekst vijesti: </label>
                        <textarea name="tekst" id="tekst" class="unos_polje " rows="10" required></textarea>
                    </div>

                    <div class="unos_red">
                        <label for="kategorija">Kategorija vijesti: </label>
                        <select name="kategorija" id="kategorija" class="unos_polje" required>
                            <option value="aktualno">Aktualno</option>
                            <option value="sport">Sport</option>
                        </select>
                    </div>

                    <div class="unos_red">
                        <label for="slika">Odabir slike</label>
                        <input type="file" name="slika" id="slika" class="unos_polje" accept="image/*" required>
                    </div>

                    <div class="unos_red unos_checkbox_red">
                        <label for="arhiva">Arhivirati vijest? </label>
                        <input type="checkbox" name="arhiva" id="arhiva" class="unos_checkbox">
                    </div>

                    <div class="unos_gumbi">
                        <button type="reset" class="unos_gumb">Poništi</button>
                        <button type="submit" class="unos_gumb">Pošalji</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</main>

<?php include 'HiF/footer.php'; ?>
</body>
</html>