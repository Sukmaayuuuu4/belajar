<!DOCTYPE html>
<html>
<head>
    <title>Diagnosa Penyakit Bawang Merah</title>
</head>
<body>
    <h2>Diagnosa Penyakit Bawang Merah</h2>
    <form action="<?= site_url('diagnosa/proses') ?>" method="post">
        <?php foreach ($gejala as $g) : ?>
            <p><strong><?= $g->nama_gejala ?></strong></p>
            <?php
                $keyakinan = [
                    '1'   => 'Sangat Yakin (1)',
                    '0.8' => 'Yakin (0.8)',
                    '0.6' => 'Cukup Yakin (0.6)',
                    '0.4' => 'Ragu-ragu (0.4)',
                    '0.2' => 'Tidak Yakin (0.2)',
                    '0'   => 'Tidak Tahu (0)'
                ];
            ?>
            <?php foreach ($keyakinan as $nilai => $label) : ?>
                <label>
                    <input type="radio" name="gejala[<?= $g->id_gejala ?>]" value="<?= $nilai ?>" required>
                    <?= $label ?>
                </label><br>
            <?php endforeach; ?>
            <hr>
        <?php endforeach; ?>
        <button type="submit">Diagnosa</button>
    </form>
</body>
</html>
