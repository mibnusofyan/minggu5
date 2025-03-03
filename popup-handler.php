<?php
$showPopup = false;
$popupMessage = "";
$popupTitle = "";
$teamMember = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] == "showPopup") {
            $showPopup = true;

            if (isset($_POST["member"])) {
                $teamMember = $_POST["member"];
                switch ($teamMember) {
                    case "Jane":
                        $popupTitle = "Kontak Jane Doe";
                        $popupMessage = "Email: jane.doe@example.com<br>Phone: +62 812 3456 7890";
                        break;
                    case "Mike":
                        $popupTitle = "Kontak Mike Ross";
                        $popupMessage = "Email: mike.ross@example.com<br>Phone: +62 898 7654 3210";
                        break;
                    case "John":
                        $popupTitle = "Kontak John Doe";
                        $popupMessage = "Email: john.doe@example.com<br>Phone: +62 877 1234 5678";
                        break;
                    default:
                        $popupTitle = "Informasi Kontak";
                        $popupMessage = "Detail kontak tidak tersedia.";
                }
            } else {
                $popupTitle = "Informasi Pesan Tiket";
                $popupMessage = "Silakan isi form berikut untuk memesan tiket Menara Pandang Teratai.";
            }
        }
        elseif ($_POST["action"] == "confirmAction") {
            $showPopup = true;
            $popupTitle = "Pesan Berhasil Dikirim";
            $popupMessage = "Terima kasih! Pesan Anda telah dikirim pada " . date("d-m-Y H:i:s");
        }
    }
}
