<?php
$id = 1;
// Array Pertama
// Sudah di deklarasikan
$array1 = array(
    array(
        "alas" => 2,
        "tinggi" => 4.5
    ),
    array(
        "alas" => 3,
        "tinggi" => 6.5
    ),
    array(
        "alas" => 3,
        "tinggi" => 3
    ),
    array(
        "alas" => 3,
        "tinggi" => 3
    ),
    array(
        "alas" => 3,
        "tinggi" => 2
    )
);

// array inputan
if (isset($_POST['segitiga'])) {
    //     
    $alas2 = $_POST['alas'];
    $tinggi2 = $_POST['tinggi'];

    $luas2 = 1 / 2 * $alas2 * $tinggi2;


    // masukan data
    extract($_REQUEST);

    $namaFile = "data_luas_segitiga.csv";
    $file = fopen($namaFile, "a");
    $konten = $alas2 . "|" . $tinggi2 . "|" . $luas2 . "\n";

    fwrite($file, $konten);

    fclose($file);

    $isiFileSegitiga = file("data_luas_segitiga.csv");

    foreach ($isiFileSegitiga as $key => $value) {
        $data = explode("|", $value);
        $array2[] = $data;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web2 | Nurdiansah</title>

    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/grid.css">
</head>

<body>
    <div class="container mt-3">
        <h2 class="text-center mb-5">Pemograman Web 2 <br>Latihan Pertemuan 06<br>Nurdiansah</h2>
        <!-- Table -->
        <h3>Array secara langsung di definisikan</h3>
        <h4>Rumus Luas Segitiga : L = ½ × a × t</h4>
        <div class="col-sm-12 col-md-12 mt-3">
            <table class="table table-striped">
                <caption>Array secara langsung di definisikan</caption>
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Alas</td>
                        <td>Tinggi</td>
                        <td>Luas</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($array1 as $key => $value) {
                        $alas = $value['alas'];
                        $tinggi = $value['tinggi'];

                        $luas = 1 / 2 * $alas * $tinggi;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $alas; ?></td>
                            <td><?= $tinggi; ?></td>
                            <td><?= $luas; ?></td>
                        </tr>
                    <?php
                        $no++;
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- Endtable -->
        <!-- Form -->
        <?php if (isset($_POST['segitiga'])) { ?>
            <div class="alert alert-success mt-3" role="alert">
                Berhasil di simpan!
            </div>
        <?php } ?>
        <h3>Form Input Segitiga</h3>
        <div class="row">
            <!-- Form  1-->
            <div class="col-sm-3">
                <form action="" method="POST">
                    <div class="card">
                        <div class="card-header bg-warning">
                            Segitiga
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>alas</label>
                                <input type="number" name="alas" class="form-control" autocomplete="off" required step="any" min="0.01">
                            </div>
                            <div class=" form-group">
                                <label>Tinggi</label>
                                <input type="number" name="tinggi" class="form-control" autocomplete="off" required step="any" min="0.01">
                            </div>
                            <button type="submit" name="segitiga" class="btn btn-primary float-right">Hitung</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Table -->
            <!-- <h3>Array secara langsung di definisikan</h3>
            <h4>Rumus Luas Segitiga : L = ½ × a × t</h4> -->
            <div class="col-sm-9">
                <table class="table table-striped">
                    <caption>Array Inputan</caption>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Alas</td>
                            <td>Tinggi</td>
                            <td>Luas</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no2 = 1;
                        foreach ($array2 as $key => $value) {
                            $alas2 = $value[0];
                            $tinggi2 = $value[1];
                            $luas2 = $value[2];

                        ?>
                            <tr>
                                <td><?= $no2; ?></td>
                                <td><?= $alas2; ?></td>
                                <td><?= $tinggi2; ?></td>
                                <td><?= $luas2; ?></td>
                            </tr>
                        <?php
                            $no2++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- Endtable -->
        </div>
        <!-- Endform -->
    </div>
</body>

</html>