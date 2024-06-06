<?php
$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ans = $_POST;

    if (empty($ans["username"])) {
        echo '<div id="ulogirani">Korisnički račun nije unesen.</div>';
    } elseif (empty($ans["password"])) {
        echo '<div id="ulogirani">Lozinka nije unesena</div>';
    } else {
        $username = $ans["username"];
        $password = $ans["password"];
        provjera($username, $password);
    }
}

function provjera($username, $password) {
    $html = ''; // Inicijalizacija prazne varijable koja će kasnije sadržavati HTML

    $xml = simplexml_load_file("users.xml");

    foreach ($xml->user_list->user as $usr) {
        $usrn = (string)$usr->username;
        $usrp = (string)$usr->password;
        $usrime = (string)$usr->ime;
        $usrprezime = (string)$usr->prezime;

        if ($usrn == $username) {
            if ($usrp == $password) {
                $html = '<div id="ulogirani">
                            <p>Uspješno ste ulogirani kao ' . (isset($usrime) ? $usrime . ' ' : '') . (isset($usrprezime) ? $usrprezime : '') . '</p>
                        </div>';
                $html .= '<script>
                            setTimeout(function() {
                                window.location.href = "main.php";
                            }, 3000);
                          </script>';
                break; // Prekid petlje jer je korisnik pronađen
            } else {
                echo '<div id="ulogirani">Netočna lozinka.</div>';

                return;
            }
        }
    }

    if (empty($html)) {
       echo '<div id="ulogirani">Korisnik ne postoji.</div>';
    } else {
        echo $html;
    }
}
?>



<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="log">
        <form action="" method="post">
            <table>
                <tr>
                    <td><label>Korisnički račun:</label></td>
                </tr>
                <tr>
                    <td><input id="name" name="username" type="text"><br/><br/></td>
                </tr>
                <tr>
                    <td><label>Lozinka:</label></td>
                </tr>
                <tr>
                    <td><input id="password" name="password" placeholder="*****" type="password"><br/><br/></td>
                </tr>
                <tr>
                    <td><input name="submit" type="submit" value="Login" class="but"></td>
                </tr>
            </table>
        </form>
    </div>

    <div id="users">
        <div id="us1">
            <h4>User 1</h4>
            <p>Username: Osoba1</p>
            <p>Password: 12345</p>
        </div>
        <div id="space"></div>
        <div id="us2">
            <h4>User 2</h4>
            <p>Username: Osoba2</p>
            <p>Password: 12345</p>
        </div>
    </div>
</body>
</html>

