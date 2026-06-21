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
    <title><?php echo ucfirst($_GET['kategorija']);?></title>
</head>
<body>

<?php include 'HiF/header.php'; ?>

<main>
    <section class="sekcija_kategorija">
        <div class="wrapper">
            <div class="Dsection">
                <?php

                $kategorija = $_GET['kategorija'];

                if ($kategorija == "aktualno") {
                    echo '<div class="section_naslov">';
                    echo '<h2>Aktualno</h2>';
                } elseif ($kategorija == "sport") {
                    echo '<div class="section_naslov">';
                    echo '<h2>Sport</h2>';
                }
                ?>
                    <hr>
                </div>

                <div class="vijesti kategorija_vijesti">
                    <?php
                    $query= "SELECT * FROM vijesti
                              WHERE arhiva=0 AND kategorija='$kategorija'
                              ORDER BY id DESC";
                    $result= mysqli_query($dbc, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        echo '<article class="pocetna_vijesti kategorija_clanak">';
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