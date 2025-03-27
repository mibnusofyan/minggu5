<?php
include 'popup-handler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menara Pandang Teratai</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="header">
        <img class="logo-nav" src="images/logo.png" alt="logo menara">
        <h2>Menara Pandang Teratai</h2>
        <nav class="navigation">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="form.php">Pesan Tiket</a></li>
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="hero-content">
                <h1>Selamat datang di Menara Pandang Teratai</h1>
                <p>Tinggi menara teratai yaitu 114m, terletak di pusat kota Purwokerto. Menikmati
                    keindahan kota Purwokerto di monumen tertinggi kota satria.</p>
            </div>
            <div class="hero-buttons">
                <button><a href="form.php">Pesan Tiket</a></button>
                <button>Lihat Sejarah</button>
            </div>
        </section>

        <section class="team-section">
            <h2>Meet The Team</h2>
            <p>Kelompok Tugas Besar Pemrograman Aplikasi Web</p>
            <br>

            <div class="row">
                <div class="column">
                    <div class="card">
                        <img src="images/ibnu.png" alt="Jane" style="width:100%; height:300px;">
                        <div class="container">
                            <h3>Muhammad Ibnu Sofyan</h3>
                            <p class="title">FrontEnd Developer</p>
                            <p>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="showPopup">
                                <input type="hidden" name="member" value="Jane">
                                <button type="submit" class="show-popup-button">More Details</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <img src="images/farrel.jpg" alt="Mike" style="width:100%; height:300px;">
                        <div class="container">
                            <h3>Meiwildan Muhammad Farrel</h3>
                            <p class="title">UI UX & Hosting</p>
                            <p>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="showPopup">
                                <input type="hidden" name="member" value="Mike">
                                <button type="submit" class="show-popup-button">More Details</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <img src="images/jaizz.JPG" alt="John" style="width:100%; height:300px;">
                        <div class="container">
                            <h3>Jaiz Cahya Prasetya</h3>
                            <p class="title">Backend Developer</p>
                            <p>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="showPopup">
                                <input type="hidden" name="member" value="John">
                                <button type="submit" class="show-popup-button">More Details</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <img src="images/dedy.jpeg" alt="Yuka" style="width:100%; height:300px;">
                        <div class="container">
                            <h3>Dedy Tigor Manurung</h3>
                            <p class="title">Database& Server</p>
                            <p>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="showPopup">
                                <input type="hidden" name="member" value="Yuka">
                                <button type="submit" class="show-popup-button">More Details</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include 'popup-component.php';
        ?>

    </main>
    <script>
        function closePopup() {
            document.getElementById('popupContainer').style.display = 'none';
        }
    </script>
</body>

</html>