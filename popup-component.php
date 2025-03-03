<div class="popup-container" id="popupContainer" <?php if ($showPopup) echo 'style="display: flex;"'; ?>>
    <div class="popup">
        <div class="popup-header">
            <h3 class="popup-title"><?php echo $popupTitle; ?></h3>
            <button class="close-btn" onclick="closePopup()">&times;</button>
        </div>
        <div class="popup-content">
            <?php if ($teamMember != "" && isset($popupNim) && isset($popupKelas) && isset($popupEmail)): ?>
                <div class="team-info">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">NIM</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?php echo $popupNim; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Kelas</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?php echo $popupKelas; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Email</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?php echo $popupEmail; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Peran</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?php echo $popupJob; ?></td>
                        </tr>
                    </table>
                </div>
            <?php else: ?>
                <p><?php echo $popupJob; ?></p>
            <?php endif; ?>
        </div>
        <div class="popup-footer">
            <button type="button" class="popup-btn" onclick="closePopup()">Tutup</button>
        </div>
    </div>
</div>