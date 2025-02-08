<!DOCTYPE html>
<html>
<head>
    <title>Hasil Diagnosa</title>
</head>
<body>
    <h2>Hasil Diagnosa</h2>
    <?php if (!empty($hasil)) : ?>
        <table border="1">
            <tr>
                <th>Penyakit</th>
                <th>Certainty Factor</th>
            </tr>
            <?php foreach ($hasil as $h) : ?>
                <tr>
                    <td><?= $h['nama_penyakit'] ?></td>
                    <td><?= $h['cf'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Tidak ada penyakit yang terdeteksi.</p>
    <?php endif; ?>
</body>
</html>
