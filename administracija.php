<?php
session_start();
include 'connect.php';

$uspjesnaPrijava = false;
$admin = false;
$msg = "";
$nepostojeci = false;

if (isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['korisnicko_ime'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];

    $sql = "SELECT ime, korisnicko_ime, lozinka, razina 
            FROM korisnik 
            WHERE korisnicko_ime = ?";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $korisnickoImeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);
    }

    if (mysqli_stmt_num_rows($stmt) == 0) {
        $nepostojeci = true;
    }

    if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika)) {
        $uspjesnaPrijava = true;

        if ($levelKorisnika == 1) {
            $admin = true;
        } else {
            $admin = false;
        }

        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level'] = $levelKorisnika;
    } else {
        $uspjesnaPrijava = false;
        if (!$nepostojeci) {
            $msg = "Nepoznata lozinka";
        }
    }
}


if (isset($_POST['delete'])) {
    $id = (int) $_POST['id'];

    $sql = "DELETE FROM vijesti WHERE id = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
    }
}


if (isset($_POST['update'])) {
    $id = (int) $_POST['id'];

    if (isset($_FILES['image']) && $_FILES['image']['size'] != 0) {
        $picture = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $picture);
    } else {
        $picture = $_POST['imagecurrent'];
    }

    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    $sql = "UPDATE vijesti 
            SET naslov = ?, sazetak = ?, tekst = ?, slika = ?, kategorija = ?, arhiva = ?
            WHERE id = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'sssssii', $naslov, $sazetak, $tekst, $picture, $kategorija, $arhiva, $id);
        mysqli_stmt_execute($stmt);
    }
}


if (isset($_POST['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    session_destroy();
    header("Location: administracija.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'HiF/header.php'; ?>

<section>
    <div class="wrapper">
        <div class="sectionContainer">
            <?php if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['username']) && $_SESSION['level'] == 1)) { ?>

                <div class="admin_top">
                    <h1>Popis vijesti</h1>
                    <form class="admin_logout" action="" method="post">
                        <input type="hidden" name="logout" value="true">
                        <button type="submit">Logout</button>
                    </form>
                </div>

                <div class="admin_vijesti_lista">
                    <div class="admin_vijesti_row first_row">
                        <div class="admin_vijesti_cell"><p>Id</p></div>
                        <div class="admin_vijesti_cell"><p>Kategorija</p></div>
                        <div class="admin_vijesti_cell"><p>Naslov</p></div>
                        <div class="admin_vijesti_cell"><p>Slika</p></div>
                        <div class="admin_vijesti_cell"><p>Kratki sažetak</p></div>
                        <div class="admin_vijesti_cell"><p>Sadržaj</p></div>
                        <div class="admin_vijesti_cell"><p>Arhiviranje</p></div>
                        <div class="admin_vijesti_cell"><p>Opcije</p></div>
                    </div>

                    <?php
                    $query = "SELECT * FROM vijesti";
                    $result = mysqli_query($dbc, $query);

                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <form class="admin_vijesti_row" enctype="multipart/form-data" action="" method="post">
                            <div class="admin_vijesti_cell">
                                <p><?php echo $row['id']; ?></p>
                            </div>

                            <div class="admin_vijesti_cell">
                                <select name="kategorija">
                                    <option value="aktualno" <?php if ($row['kategorija'] == 'aktualno') echo 'selected'; ?>>Aktualno</option>
                                    <option value="sport" <?php if ($row['kategorija'] == 'sport') echo 'selected'; ?>>Sport</option>
                                </select>
                            </div>

                            <div class="admin_vijesti_cell">
                                <textarea name="naslov" maxlength="64" required><?php echo $row['naslov']; ?></textarea>
                            </div>

                            <div class="admin_vijesti_cell admin_image_preview">
                                <input type="file" name="image">
                                <div>
                                    <img src="images/<?php echo $row['slika']; ?>" alt="<?php echo $row['naslov']; ?>">
                                </div>
                            </div>

                            <div class="admin_vijesti_cell">
                                <textarea name="sazetak" cols="30" rows="10" maxlength="100" required><?php echo $row['sazetak']; ?></textarea>
                            </div>

                            <div class="admin_vijesti_cell">
                                <textarea name="tekst" cols="30" rows="10" maxlength="10000" required><?php echo $row['tekst']; ?></textarea>
                            </div>

                            <div class="admin_vijesti_cell">
                                <input type="checkbox" name="arhiva" <?php if ($row['arhiva'] == 1) echo 'checked'; ?>>
                            </div>

                            <div class="admin_vijesti_cell admin_buttons">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="imagecurrent" value="<?php echo $row['slika']; ?>">
                                <button type="reset">Poništi</button>
                                <button type="submit" name="update">Izmjeni</button>
                                <button type="submit" name="delete">Izbriši</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>

            <?php } else if ($uspjesnaPrijava == true && $admin == false) { ?>

                <p class="admin_not_admin">Pozdrav <?php echo $imeKorisnika; ?>! Uspješno ste prijavljeni, ali niste administrator.</p>
                <form class="admin_logout niste_logout" action="" method="post">
                    <input type="hidden" name="logout" value="true">
                    <button type="submit">Logout</button>
                </form>

            <?php } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) { ?>

                <p class="admin_not_admin">Pozdrav <?php echo $_SESSION['username']; ?>! Uspješno ste prijavljeni, ali niste administrator.</p>
                <form class="admin_logout niste_logout" action="" method="post">
                    <input type="hidden" name="logout" value="true">
                    <button type="submit">Logout</button>
                </form>

            <?php } else { ?>

                <div class="login_container login_forma">
                    <form class="login" action="" method="POST">
                        <div class="loginItem">
                            <label for="korisnicko_ime">Korisničko ime:</label>
                            <div class="loginInput">
                                <input type="text" name="korisnicko_ime" id="korisnicko_ime" maxlength="40" required autofocus>
                                <p id="porukaKorisnickoIme"></p>
                            </div>
                        </div>

                        <div class="loginItem" id="admin_input_separator">
                            <label for="lozinka">Lozinka:</label>
                            <div class="loginInput">
                                <input type="password" name="lozinka" id="lozinka" maxlength="40" required>
                                <p id="porukaLozinka"></p>
                            </div>
                        </div>

                        <div class="loginButtons">
                            <button type="submit" value="Prijava" name="prijava" id="slanje" class="loginGumb">Prijava</button>
                        </div>

                        <?php
                        if ($nepostojeci) {
                            echo '<p class="nepostojeci">Nepoznati korisnik, molim vas da se registrirate <a href="registracija.php">ovdje</a>!</p>';
                        } else if (!empty($msg)) {
                            echo '<p class="nepostojeci">' . $msg . '</p>';
                        }
                        ?>
                    </form>
                </div>

                <script type="text/javascript">
                    document.getElementById("slanje").onclick = function(event) {
                        var slanjeForme = true;

                        var poljeKorisnickoIme = document.getElementById("korisnicko_ime");
                        var korisnickoIme = document.getElementById("korisnicko_ime").value;
                        if (korisnickoIme.length == 0) {
                            slanjeForme = false;
                            poljeKorisnickoIme.style.border = "2px dashed red";
                            document.getElementById("porukaKorisnickoIme").innerHTML = "(Unesite svoje korisničko ime!)";
                        } else if (korisnickoIme.length > 32) {
                            slanjeForme = false;
                            poljeKorisnickoIme.style.border = "2px dashed red";
                            document.getElementById("porukaKorisnickoIme").innerHTML = "(Korisničko ime ne smije biti duže od 32 znaka!)";
                        } else {
                            poljeKorisnickoIme.style.border = "2px solid green";
                            document.getElementById("porukaKorisnickoIme").innerHTML = "";
                        }

                        var poljeLozinka = document.getElementById("lozinka");
                        var lozinka = document.getElementById("lozinka").value;
                        if (lozinka.length == 0) {
                            slanjeForme = false;
                            poljeLozinka.style.border = "2px dashed red";
                            document.getElementById("porukaLozinka").innerHTML = "(Unesite svoju lozinku!)";
                        } else if (lozinka.length > 32) {
                            slanjeForme = false;
                            poljeLozinka.style.border = "2px dashed red";
                            document.getElementById("porukaLozinka").innerHTML = "(Lozinka ne smije biti duža od 32 znaka!)";
                        } else {
                            poljeLozinka.style.border = "2px solid green";
                            document.getElementById("porukaLozinka").innerHTML = "";
                        }

                        if (slanjeForme != true) {
                            event.preventDefault();
                        }
                    };
                </script>

            <?php } ?>
        </div>
    </div>
</section>

<?php include 'HiF/footer.php'; ?>
</body>
</html>