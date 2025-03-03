<?php
$showPopup = false;
$popupJob = "";
$popupTitle = "";
$popupNim = "";
$popupKelas = "";
$popupEmail = "";
$teamMember = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] == "showPopup") {
            $showPopup = true;

            if (isset($_POST["member"])) {
                $teamMember = $_POST["member"];
                switch ($teamMember) {
                    case "Jane":
                        $popupTitle = "Muhammad Ibnu Sofyan";
                        $popupNim = "2311103053";
                        $popupKelas = "07E";
                        $popupEmail = "muhammadibnusofyan003@gmail.com";
                        $popupJob = "Frontend Developer";
                        break;
                    case "Mike":
                        $popupTitle = "Meiwildan Muhammad Farrel";
                        $popupNim = "000000000";
                        $popupKelas = "07E";
                        $popupEmail = "xxxx@gmail.com";
                        $popupJob = "UI/UX & Hosting";
                        break;
                    case "John":
                        $popupTitle = "Jaiz Cahya Prasetya";
                        $popupNim = "000000000";
                        $popupKelas = "07E";
                        $popupEmail = "xxxx@gmail.com";
                        $popupJob = "Backend Developer";
                        break;
                    case "Yuka":
                        $popupTitle = "Dedy Tigor Manurung";
                        $popupNim = "000000000";
                        $popupKelas = "07E";
                        $popupEmail = " xxxx@gmail.com";
                        $popupJob = "Database";
                        break;
                    default:
                        $popupTitle = "Informasi Anggota";
                        $popupJob = "Detail anggota tidak tersedia.";
                }
            } else {
                $popupTitle = "Informasi Pesan Tiket";
                $popupJob = "Silakan isi form berikut untuk memesan tiket Menara Pandang Teratai.";
            }
        } elseif ($_POST["action"] == "confirmAction") {
            $showPopup = true;
            $popupTitle = "Pesan Berhasil Dikirim";
            $popupJob = "Terima kasih! Pesan Anda telah dikirim pada " . date("d-m-Y H:i:s");
        }
    }
}
