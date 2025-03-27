<?php
$nama = $email = $nomor = $tiket = $tanggal = $permintaan = "";
$namaErr = $emailErr = $nomorErr = $tanggalErr = $permintaanErr = "";
$successMessage = "";

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi";
    }

    $email = $_POST["email"];
    if (empty($email)) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    }

    $nomor = $_POST["nomor"];
    if (empty($nomor)) {
        $nomorErr = "Nomor Telepon wajib diisi";
    } elseif (!ctype_digit($nomor)) {
        $nomorErr = "Nomor Telepon harus berupa angka";
    }

    $tanggal = $_POST["tanggal"];
    if (empty($tanggal)) {
        $tanggalErr = "Tanggal wajib diisi";
    }

    $permintaan = $_POST["permintaan"];
    if (empty($permintaan)) {
        $permintaanErr = "Permintaan wajib diisi";
    }

    $tiket = $_POST["tiket"];

    if (!$namaErr && !$emailErr && !$nomorErr && !$tanggalErr && !$permintaanErr) {
        $checkUser = "SELECT id FROM users WHERE email = ?";
        $stmtCheckUser = $conn->prepare($checkUser);
        $stmtCheckUser->bind_param("s", $email);
        $stmtCheckUser->execute();
        $userResult = $stmtCheckUser->get_result();

        $userId = null;

        if ($userResult->num_rows > 0) {
            $userData = $userResult->fetch_assoc();
            $userId = $userData['id'];
        } else {
            $default_password = password_hash(uniqid(), PASSWORD_DEFAULT);

            $insertUser = "INSERT INTO users (name, email, phone_number, password, role, created_at, updated_at) 
                  VALUES (?, ?, ?, ?, 'user', NOW(), NOW())";
            $stmtUser = $conn->prepare($insertUser);
            $stmtUser->bind_param("ssss", $nama, $email, $nomor, $default_password);

            if ($stmtUser->execute()) {
                $userId = $conn->insert_id;
            } else {
                echo "Error: " . $stmtUser->error;
            }
            $stmtUser->close();
        }

        $stmtCheckUser->close();

        $ticketType = explode(" - ", $tiket)[0];

        $getTicketTypeId = "SELECT id FROM ticket_types WHERE name = ?";
        $stmtTicketType = $conn->prepare($getTicketTypeId);
        $stmtTicketType->bind_param("s", $ticketType);
        $stmtTicketType->execute();
        $ticketTypeResult = $stmtTicketType->get_result();

        if ($ticketTypeResult->num_rows > 0) {
            $ticketTypeData = $ticketTypeResult->fetch_assoc();
            $ticketTypeId = $ticketTypeData['id'];

            $getPrice = "SELECT price FROM ticket_types WHERE id = ?";
            $stmtPrice = $conn->prepare($getPrice);
            $stmtPrice->bind_param("i", $ticketTypeId);
            $stmtPrice->execute();
            $priceResult = $stmtPrice->get_result();
            $priceData = $priceResult->fetch_assoc();
            $price = $priceData['price'];
            $stmtPrice->close();

            $quantity = 1;
            $totalPrice = $price * $quantity;

            $bookingCode = "MPT" . date("YmdHis") . rand(100, 999);

            $insertBooking = "INSERT INTO bookings (booking_code, user_id, ticket_type_id, visit_date, quantity, 
                              total_price, special_request, payment_status, created_at, updated_at) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW(), NOW())";

            $stmtBooking = $conn->prepare($insertBooking);
            $stmtBooking->bind_param(
                "siisids",
                $bookingCode,
                $userId,
                $ticketTypeId,
                $tanggal,
                $quantity,
                $totalPrice,
                $permintaan
            );

            if ($stmtBooking->execute()) {
                $successMessage = "Pembelian tiket berhasil! Kode booking Anda: " . $bookingCode;
            } else {
                echo "Error: " . $stmtBooking->error;
            }

            $stmtBooking->close();
        } else {
            echo "Error: Tipe tiket tidak ditemukan";
        }

        $stmtTicketType->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembelian Tiket</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <div class="container">
        <h2>Form Pembelian Tiket</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Masukkan Email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor Telepon:</label>
                <input type="text" id="nomor" name="nomor" placeholder="Masukkan Nomor Telepon" value="<?php echo $nomor; ?>">
                <span class="error"><?php echo $nomorErr ? "* $nomorErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="tiket">Pilih tiket:</label>
                <select id="tiket" name="tiket">
                    <option value="Premium - Rp. 25.000" <?php echo ($tiket == "Premium - Rp. 25.000") ? "selected" : ""; ?>>Premium - Rp. 25.000</option>
                    <option value="Reguler - Rp. 20.000" <?php echo ($tiket == "Reguler - Rp. 20.000") ? "selected" : ""; ?>>Reguler - Rp. 20.000</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal" class="col-sm-2 control-label">Tanggal:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
                    <span class="error"><?php echo $tanggalErr ? "* $tanggalErr" : ""; ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="permintaan">Permintaan Khusus:</label>
                <textarea id="permintaan" name="permintaan" placeholder="Isi permintaan khusus"><?php echo $permintaan; ?></textarea>
                <span class="error"><?php echo $permintaanErr ? "* $permintaanErr" : ""; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Beli tiket</button>
            </div>
        </form>
    </div>

    <?php if (!empty($successMessage)) { ?>
        <div class="container success-message">
            <h3><?php echo $successMessage; ?></h3>
            <p>Terima kasih telah memesan tiket di Menara Pandang Teratai.</p>
            <p>Silahkan lakukan pembayaran untuk menyelesaikan proses pemesanan.</p>
            <div class="button-container">
                <button onclick="window.location.href='index.php'">Kembali ke Beranda</button>
            </div>
        </div>
    <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$tanggalErr && !$permintaanErr) { ?>
        <div class="container">
            <h3>Data Pembelian Tiket</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="20%">Nama</th>
                            <th width="20%">Email</th>
                            <th width="15%">Nomor Telepon</th>
                            <th width="15%">Tiket</th>
                            <th width="15%">Tanggal</th>
                            <th width="30%">Permintaan Khusus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $nama; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $tiket; ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $permintaan; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

    <?php
    if (isset($conn)) {
        $conn->close();
    }
    ?>
</body>

</html>