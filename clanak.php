<?php
session_start();
include 'connect.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM vijesti WHERE id = $id";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
} else {
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Članak</title>
</head>
<body>

<?php include 'HiF/header.php'; ?>

<div class="clanak_kategorija sekcija_<?php echo $row['kategorija']; ?>">
    <div class="wrapper">
        <span><?php echo strtoupper($row['kategorija']); ?></span>
    </div>
</div>

<main>
    <div class="wrapper">
        <article class="clanak">
            <h1 class="clanak_naslov"><?php echo htmlspecialchars($row['naslov']); ?></h1>
            <div class="clanak_slika">
                <img src="images/<?php echo $row['slika']; ?>" alt="<?php echo htmlspecialchars($row['naslov']); ?>">
            </div>
            <div class="clanak_tekst">
                <p><?php echo nl2br(htmlspecialchars($row['tekst'])); ?></p>
            </div>
        </article>
    </div>
</main>

<?php include 'HiF/footer.php'; ?>
    
</body>
</html>