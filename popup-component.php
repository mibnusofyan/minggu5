<div class="popup-container" id="popupContainer" <?php if ($showPopup) echo 'style="display: flex;"'; ?>>
    <div class="popup">
        <div class="popup-header">
            <h3 class="popup-title"><?php echo $popupTitle; ?></h3>
            <button class="close-btn" onclick="closePopup()">&times;</button>
        </div>
        <div class="popup-content">
            <p><?php echo $popupMessage; ?></p>

            <?php if ($teamMember == "" && strpos($popupTitle, "Pesan Tiket") !== false): ?>
                <form method="post" action="">
                    <div style="margin-bottom: 15px;">
                        <label for="name" style="display: block; margin-bottom: 5px;">Nama:</label>
                        <input type="text" id="name" name="name" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
                        <input type="email" id="email" name="email" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="date" style="display: block; margin-bottom: 5px;">Tanggal Kunjungan:</label>
                        <input type="date" id="date" name="date" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="visitors" style="display: block; margin-bottom: 5px;">Jumlah Pengunjung:</label>
                        <input type="number" id="visitors" name="visitors" min="1" max="10" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <input type="hidden" name="action" value="confirmAction">
                </form>
            <?php endif; ?>
        </div>
        <div class="popup-footer">
            <?php if (strpos($popupTitle, "Kontak") !== false): ?>
                <form method="post" action="">
                    <input type="hidden" name="action" value="confirmAction">
                    <input type="hidden" name="member" value="<?php echo $teamMember; ?>">
                    <button type="button" class="btn btn-secondary" onclick="closePopup()">Tutup</button>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            <?php elseif (strpos($popupTitle, "Pesan Tiket") !== false): ?>
                <button type="button" class="btn btn-secondary" onclick="closePopup()">Batal</button>
                <button type="submit" class="btn" form="ticket-form">Pesan Sekarang</button>
            <?php else: ?>
                <button type="button" class="btn" onclick="closePopup()">Tutup</button>
            <?php endif; ?>
        </div>
    </div>
</div>