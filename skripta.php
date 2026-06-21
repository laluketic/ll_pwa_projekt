<?php
include 'connect.php';

$naslov= $_POST['naslov'];
$sazetak= $_POST['sazetak'];
$tekst= $_POST['tekst'];
$kategorija= $_POST['kategorija'];

if(isset($_POST['arhiva'])) {
    $arhiva= 1;
} else {
    $arhiva= 0;
}

$slika= $_FILES['slika']['name'];
$target= 'images/' . $slika;
move_uploaded_file($_FILES['slika']['tmp_name'], $target);

$sql= "INSERT INTO vijesti (naslov, sazetak, tekst, slika, kategorija, arhiva) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt= mysqli_stmt_init($dbc);

if(mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "sssssi", $naslov, $sazetak, $tekst, $slika, $kategorija, $arhiva);
    mysqli_stmt_execute($stmt);
} else {
    die('Greška pri unosu.');
}

mysqli_stmt_close($stmt);
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'HiF/header.php'; ?>

<main>
    <section role="main" class="clanak">
        <div class="wrapper">

            <p class="kategorija">
                <?php echo htmlspecialchars($kategorija); ?>
            </p>

            <h1 class="naslov">
                <?php echo htmlspecialchars($naslov); ?>
            </h1>

            <section class="slika">
                <img src="images/<?php echo htmlspecialchars($slika); ?>" alt="<?php echo htmlspecialchars($naslov); ?>">
            </section>

            <section class="about">
                <p><?php echo htmlspecialchars($sazetak); ?></p>
            </section>

            <section class="sadrzaj">
                <p><?php echo htmlspecialchars($tekst); ?></p>
            </section>

        </div>
    </section>
</main>

<?php include 'HiF/footer.php'; ?>

</body>
</html>