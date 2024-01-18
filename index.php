<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
    <title>CRUD PHP</title>
</head>
<body>
    <header></header>
    <main>
        <?php
        session_start();
        ?>
        <section id="dodaj">
            <form id="dodaj-form" action="index.php" method="post">
                <p>Liczba dodanych postów: <?php echo isset($_SESSION['l_d']) ? $_SESSION['l_d'] : 0; ?></p>
                <input type="button" class="invis d-cof" id="cofnij" value="↩">
                <label for="d-tytul">Tytuł: </label>
                <input type="text" id="d-tytul" name="d-tytul"><br>
                <label for="d-tresc">Treść: </label>
                <input type="text" id="d-tresc" name="d-tresc"><br>
                <button type="submit">Dodaj</button>
            
            <?php
            

            $conn = mysqli_connect("localhost", "root", "", "crud_php");

            if ($conn->connect_error) {
                echo("Błąd połączenia: " . $conn->connect_error);
            }

            $l_d = 0;
            $l_m = 0;
            $l_u = 0;


            if (!empty($_POST["d-tytul"]) && !empty($_POST["d-tresc"])) {
                $d_tytul = $_POST["d-tytul"];

                $d_powt_sql = "SELECT post_id FROM posts WHERE post_title = '$d_tytul'";
                $d_powt_wyn = mysqli_query($conn, $d_powt_sql);

                if ($d_powt_wyn->num_rows > 0) {
                    echo("Post o podanym tytule już istnieje!");
                }
                else {
                    $d_tresc = $_POST["d-tresc"];
                    $d_data_sql = "SELECT CURRENT_TIMESTAMP()";
                    $d_data = mysqli_query($conn, $d_data_sql);
                    $dd = mysqli_fetch_assoc($d_data);
                    $ddd = implode($dd);
                    $d_sql = "INSERT INTO posts VALUES (null, '$d_tytul', '$d_tresc', '$ddd', '$ddd')";
                    $d_wyn = mysqli_query($conn, $d_sql);

                    if ($d_wyn === TRUE) {
                        $_SESSION['l_d'] = isset($_SESSION['l_d']) ? $_SESSION['l_d'] + 1 : 1;
                    }

                    header("Location: index.php");
                    }
            }
            else {
                
            }
            
            ?>
            </form>
        </section>
        <section id="modyfikuj">
            <form id="modyfikuj-form" action="index.php" method="post">
                <p>Liczba zmodyfikowanych postów: <?php echo isset($_SESSION['l_m']) ? $_SESSION['l_m'] : 0; ?></p>
                <input type="button" class="invis m-cof" id="cofnij" value="↩">
                <h2 class="invis" id="h-mod-id">Podaj ID do zmiany: </h2>
                <h2 class="invis" id="h-mod-tytul">Podaj tytuł do zmiany: </h2>
                <input type="text" id="mod-dane" name="mod-dane" class="invis">
                <label for="mod-id" id="l-mod-id">ID</label>
                <input type="checkbox" id="mod-id" name="mod-id-check"><br>
                <label for="mod-tytul" id="l-mod-tytul">Tytuł</label>
                <input type="checkbox" id="mod-tytul" name="mod-tytul-check">
                <h2 class="invis" id="h-mod-n-dane">Podaj nowy tytuł: </h2>
                <input type="text" id="mod-n-dane" name="mod-n-dane" class="invis">
                <h2 class="invis" id="mod-tresc">Treść:</h2>
                <input type="text" id="mod-zmiana" name="mod-zmiana" class="invis">
                <button type="submit">Modyfikuj</button>

                <?php

                    if (!empty($_POST["mod-id-check"])) {
                        $zmiana = $_POST["mod-dane"];
                        $m_tytul = $_POST["mod-n-dane"];

                        $m_id_spr_sql = "SELECT post_id FROM posts WHERE post_id = '$zmiana'";
                        $m_id_spr_wyn = mysqli_query($conn, $m_id_spr_sql);

                    if ($m_id_spr_wyn->num_rows > 0) {
                        $m_zm_post_id_sql = mysqli_fetch_assoc($m_id_spr_wyn);
                        $post_id = $m_zm_post_id_sql["post_id"];

                        $tytul_id_sql = "SELECT post_id FROM posts WHERE post_title = '$m_tytul' AND post_id != '$post_id'";
                        $tytul_id_wyn = mysqli_query($conn, $tytul_id_sql);

                        if ($tytul_id_wyn->num_rows > 0) {
                            echo("Podany tytuł jest już używany!");
                        }
                        else {
                        $m_tresc = $_POST["mod-zmiana"];
                        $m_data = "SELECT CURRENT_TIMESTAMP()";
                        $m_dataa = mysqli_query($conn, $m_data);
                        $m_dataaa = mysqli_fetch_assoc($m_dataa);
                        $m_dataaaa = implode($m_dataaa);
                        $m_sql = "UPDATE posts SET post_title = '$m_tytul', post_content = '$m_tresc', updated_at = '$m_dataaaa' WHERE post_id = '$zmiana'";
                        $m_wyn = mysqli_query($conn, $m_sql);

                        if ($m_wyn === TRUE) {
                            $_SESSION['l_m'] = isset($_SESSION['l_m']) ? $_SESSION['l_m'] + 1 : 1;
                        }
                        header("Location: index.php");
                    }
                }
                    else {
                        echo("Nie ma posta o podanym ID!");
                    }

                        
                    }
                    elseif (!empty($_POST["mod-tytul-check"])) {
                        $zmiana = $_POST["mod-dane"];
                        $m_tytul = $_POST["mod-n-dane"];

                        $m_tyt_spr_sql = "SELECT post_id FROM posts WHERE post_title = '$zmiana'";
                        $m_tyt_spr_wyn = mysqli_query($conn, $m_tyt_spr_sql);

                    if ($m_tyt_spr_wyn->num_rows > 0) {
                        $m_zm_post_tyt_sql = mysqli_fetch_assoc($m_tyt_spr_wyn);
                        $post_idd = $m_zm_post_tyt_sql["post_id"];

                        $tytul_tyt_sql = "SELECT post_id FROM posts WHERE post_title = '$m_tytul' AND post_id != '$post_idd'";
                        $tytul_tyt_wyn = mysqli_query($conn, $tytul_tyt_sql);

                    if ($tytul_tyt_wyn->num_rows > 0) {
                        echo("Podany tytuł jest już używany!");
                    }
                    else {
                        $m_tresc = $_POST["mod-zmiana"];
                        $m_data = "SELECT CURRENT_TIMESTAMP()";
                        $m_dataa = mysqli_query($conn, $m_data);
                        $m_dataaa = mysqli_fetch_assoc($m_dataa);
                        $m_dataaaa = implode($m_dataaa);
                        $m_sql = "UPDATE posts SET post_title = '$m_tytul', post_content = '$m_tresc', updated_at = '$m_dataaaa' WHERE post_title = '$zmiana'";
                        $m_wyn = mysqli_query($conn, $m_sql);

                        if ($m_wyn === TRUE) {
                            $_SESSION['l_m'] = isset($_SESSION['l_m']) ? $_SESSION['l_m'] + 1 : 1;
                        }
                        header("Location: index.php");
                    }
                }
                    else {
                        echo("Nie ma posta o podanym tytule!");
                    }

                        
                    }
                ?>
            </form>
        </section>
        <section id="usun">
            <form id="usun-form" action="index.php" method="post">
                <p>Liczba usuniętych postów: <?php echo isset($_SESSION['l_u']) ? $_SESSION['l_u'] : 0; ?></p>
                <input type="button" class="invis u-cof" id="cofnij" value="↩">
                <h2 class="invis" id="h-usun-id">Podaj ID: </h2>
                <h2 class="invis" id="h-usun-tytul">Podaj Tytuł: </h2>
                <label for="usun-id" id="l-usun-id">ID</label>
                <input type="checkbox" id="usun-id" name="u-id-check"><br>
                <label for="usun-tytul" id="l-usun-tytul">Tytuł</label>
                <input type="checkbox" id="usun-tytul" name="u-tytul-check">
                <input type="text" id="usun-dane" name="u-dane" class="invis">
                <button type="submit">Usuń</button>

                <?php
                    if (!empty($_POST["u-id-check"])) {
                        $u_dane = $_POST["u-dane"];

                        $u_id_spr_sql = "SELECT post_id FROM posts WHERE post_id = '$u_dane'";
                        $u_id_spr_wyn = mysqli_query($conn, $u_id_spr_sql);

                    if ($u_id_spr_wyn->num_rows > 0) {
                        $u_sql = "DELETE FROM posts WHERE post_id = '$u_dane'";
                        $u_wyn = mysqli_query($conn, $u_sql);

                        if ($u_wyn === TRUE) {
                            $_SESSION['l_u'] = isset($_SESSION['l_u']) ? $_SESSION['l_u'] + 1 : 1;
                        }
                        header("Location: index.php");
                    }
                    else {
                        echo("Nie ma posta o podanym ID!");
                    }

                        
                    }
                    elseif (!empty($_POST["u-tytul-check"])) {
                        $u_dane = $_POST["u-dane"];

                        $u_tyt_spr_sql = "SELECT post_id FROM posts WHERE post_title = '$u_dane'";
                        $u_tyt_spr_wyn = mysqli_query($conn, $u_tyt_spr_sql);

                    if ($u_tyt_spr_wyn->num_rows > 0) {
                        $u_sql = "DELETE FROM posts WHERE post_title = '$u_dane'";
                        $u_wyn = mysqli_query($conn, $u_sql);

                        if ($u_wyn === TRUE) {
                            $_SESSION['l_u'] = isset($_SESSION['l_u']) ? $_SESSION['l_u'] + 1 : 1;
                        }
                        header("Location: index.php");
                    }
                    else {
                        echo("Nie ma posta o podanym tytule!");
                    }
                        
                        
                    }
                ?>
            </form>
        </section>
    </main>
    <aside>
        <?php

        $posty_sql = "SELECT post_id, post_title, post_content, updated_at FROM posts ORDER BY post_id ASC";
        $posty_wyn = mysqli_query($conn, $posty_sql);

        if ($posty_wyn->num_rows > 0) {
            while($posty_row = mysqli_fetch_assoc($posty_wyn)) {
                $da = $posty_row["updated_at"];
                $data = date("H:i (d.m.Y)", strtotime($da));
                echo("<section class=post>");
                echo("<div class=p-p>");
                echo("<p>ID: " . $posty_row["post_id"] ."</p>");
                echo("<p>Utworzony: " . $data . "</p>");
                echo("</div>");
                echo("<section class=p-tytul>");
                echo("<h2>" . $posty_row["post_title"] . "</h2>");
                echo("<section class=p-tresc>");
                echo("<p>" . $posty_row["post_content"] . "</p>");
                echo("</section>");
                echo("</section>");
                echo("</section>");
            }
        }

        ?>
    </aside>
    <div id="tytul-wrp">
        <div id="tytul"><h1>CRUD PHP</h1></div>
    </div>
</body>
</html>