<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registracija</title>
</head>
<body>

<?php include 'HiF/header.php'; ?>

    <section>
        <div class="wrapper">
            <div class="Dsection">
                <?php
                $msg='';
                $msgLozinka='';
                $registriranKorisnik = false;

                if(isset($_POST['ime'])&&isset($_POST['prezime'])&&isset($_POST['korisnicko_ime'])&&isset($_POST['lozinka'])&&isset($_POST['ponovljena'])){
                    $ime = $_POST['ime'];
                    $prezime = $_POST['prezime'];
                    $korisnicko_ime = $_POST['korisnicko_ime'];
                    $lozinka = $_POST['lozinka'];
                    $ponovljena = $_POST['ponovljena'];
                    $razina = 0;

                    if($lozinka != $ponovljena){
                        $msgLozinka='Lozinke nisu iste!';
                    } else {
                        $hash_lozinka = password_hash($lozinka, CRYPT_BLOWFISH);

                        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
                        $stmt = mysqli_stmt_init($dbc);
                        if (mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                        }

                        if(mysqli_stmt_num_rows($stmt) > 0){
                            $msg='Korisničko ime je već zauzeto!';
                        }else{
                            $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($dbc);
                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $korisnicko_ime, $hash_lozinka, $razina);
                                mysqli_stmt_execute($stmt);
                                $registriranKorisnik = true;
                            }
                        }
                    }

                    mysqli_close($dbc);
                }

                if($registriranKorisnik == true) {
                    echo '<p class="registracija">Korisnik je uspješno registriran!</p>';
                } else {
                ?>
           <section class="sekcija_registracija">
                <div class="wrapper">
                    <div class="login_container">
                        <form action="" method="POST" class="login">

                            <div class="loginItem">
                                <span id="porukaIme"></span>
                                <label for="ime">Ime:</label>
                                <div class="loginInput">
                                    <input type="text" name="ime" id="ime" class="loginPolje">
                                </div>
                            </div>

                            <div class="loginItem">
                                <span id="porukaPrezime"></span>
                                <label for="prezime">Prezime:</label>
                                <div class="loginInput">
                                    <input type="text" name="prezime" id="prezime" class="loginPolje">
                                </div>
                            </div>

                            <div class="loginItem">
                                <span id="porukaUsername"></span>
                                <label for="username">Korisničko ime:</label>
                                <?php echo '<p>' . $msg . '</p>' . PHP_EOL; ?>
                                <div class="loginInput">
                                    <input type="text" name="korisnicko_ime" id="username" class="loginPolje">
                                </div>
                            </div>

                            <div class="loginItem">
                                <span id="porukaPass"></span>
                                <label for="pass">Lozinka:</label>
                                <div class="loginInput">
                                    <input type="password" name="lozinka" id="pass" class="loginPolje">
                                </div>
                            </div>

                            <div class="loginItem">
                                <span id="porukaPassRep"></span>
                                <label for="passRep">Ponovite lozinku:</label>
                                <?php echo '<p>' . $msgLozinka . '</p>' . PHP_EOL; ?>
                                <div class="loginInput">
                                    <input type="password" name="ponovljena" id="passRep" class="loginPolje">
                                </div>
                            </div>

                            <div class="loginButtons">
                                <button type="submit" name="registracija" id="slanje" class="loginGumb">Registracija</button>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
                <script type="text/javascript">
                    document.getElementById("slanje").onclick = function(event) {
                        var slanjeForme = true;

                        var poljeIme = document.getElementById("ime");
                        var ime = document.getElementById("ime").value;
                        if (ime.length == 0) {
                            slanjeForme = false;
                            poljeIme.style.border = "1px dashed red";
                            document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
                        } else {
                            poljeIme.style.border = "1px solid green";
                            document.getElementById("porukaIme").innerHTML = "";
                        }

                        var poljePrezime = document.getElementById("prezime");
                        var prezime = document.getElementById("prezime").value;
                        if (prezime.length == 0) {
                            slanjeForme = false;
                            poljePrezime.style.border = "1px dashed red";
                            document.getElementById("porukaPrezime").innerHTML = "<br>Unesite prezime!<br>";
                        } else {
                            poljePrezime.style.border = "1px solid green";
                            document.getElementById("porukaPrezime").innerHTML = "";
                        }

                        var poljeUsername = document.getElementById("username");
                        var username = document.getElementById("username").value;
                        if (username.length == 0) {
                            slanjeForme = false;
                            poljeUsername.style.border = "1px dashed red";
                            document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
                        } else {
                            poljeUsername.style.border = "1px solid green";
                            document.getElementById("porukaUsername").innerHTML = "";
                        }

                        var poljePass = document.getElementById("pass");
                        var pass = document.getElementById("pass").value;
                        var poljePassRep = document.getElementById("passRep");
                        var passRep = document.getElementById("passRep").value;

                        if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                            slanjeForme = false;
                            poljePass.style.border = "1px dashed red";
                            poljePassRep.style.border = "1px dashed red";
                            document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste!<br>";
                            document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste!<br>";
                        } else {
                            poljePass.style.border = "1px solid green";
                            poljePassRep.style.border = "1px solid green";
                            document.getElementById("porukaPass").innerHTML = "";
                            document.getElementById("porukaPassRep").innerHTML = "";
                        }

                        if (slanjeForme != true) {
                            event.preventDefault();
                        }
                    };
                </script>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'HiF/footer.php'; ?>
</body>
</html>