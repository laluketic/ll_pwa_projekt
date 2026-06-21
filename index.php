<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Početna</title>
</head>
<body>
<?php include 'HiF/header.php'; ?>

<div class="welcome">
    <div class="wrapper">
        <div class="welcome_inner">
            <div class="welcome_tekst">Dobrodošli na stranicu!</div>
            <div class="welcome_datum">
                <?php
                $dani = ['nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'četvrtak', 'petak', 'subota'];
                $mjeseci = ['siječnja', 'veljače', 'ožujka', 'travnja', 'svibnja', 'lipnja',
                            'srpnja', 'kolovoza', 'rujna', 'listopada', 'studenog', 'prosinca'];

                $dan = $dani[date('w')];
                $datum = date('j');
                $mjesec = $mjeseci[date('n') - 1];

                echo ucfirst($dan) . ', ' . $datum . '. ' . $mjesec;
                ?>
            </div>
        </div>
    </div>
</div>

<main>

<section class="sekcija_aktualno">
    <div class="wrapper">
        <div class="Dsection">
            <div class="section_naslov">
                <h2>Aktualno</h2>
                <hr>
            </div>

            <div class="vijesti">
                <?php
                $query = "SELECT * FROM vijesti
                          WHERE arhiva=0 AND kategorija='aktualno'
                          ORDER BY id DESC
                          LIMIT 3";
                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<article class="pocetna_vijesti">';
                    echo '<div class="slika_vijesti">';
                    echo '<img src="images/' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                    echo '</div>';
                    echo '<h3><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h3>';
                    echo '<p>' . $row['sazetak'] . '</p>';
                    echo '</article>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section class="sekcija_sport">
    <div class="wrapper">
        <div class="Dsection">
            <div class="section_naslov">
                <h2>Sport</h2>
                <hr>
            </div>

            <div class="vijesti">
                <?php
                $query = "SELECT * FROM vijesti
                          WHERE arhiva=0 AND kategorija='sport'
                          ORDER BY id DESC
                          LIMIT 3";
                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<article class="pocetna_vijesti">';
                    echo '<div class="slika_vijesti">';
                    echo '<img src="images/' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                    echo '</div>';
                    echo '<h3><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h3>';
                    echo '<p>' . $row['sazetak'] . '</p>';
                    echo '</article>';
                }
                ?>
            </div>
        </div>
    </div>
</section>


</main>

<?php include 'HiF/footer.php'; ?>

</body>
</html>