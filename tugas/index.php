<?php
if (isset($_POST['submit'])) {
    // studio 1
    $studio = $_POST['studio'];
    $jam_tayang = $_POST['jam_tayang'];
    $jml_tiket = $_POST['jml_tiket'];
    $makan = $_POST['makan'];
    $jml_makan = $_POST['jml_makan'];
    $minum = $_POST['minum'];
    $jml_minum = $_POST['jml_minum'];

    switch ($studio) {
        case 'Studio 1':
            $judul_film = "Extraction";
            break;
        case 'Studio 2':
            $judul_film = "Bloodshot";
            break;
        case 'Studio 2':
            $judul_film = "Bad Boys For Life";
            break;
    }

    $bayar_tiket = $jml_tiket * 75000;
    $bayar_makan = $jml_makan * 50000;
    $bayar_minum = $jml_minum * 30000;

    $total = $bayar_tiket + $bayar_makan + $bayar_minum;

    // Masukan data ke txt    
    extract($_REQUEST);

    $namaFile = "TUGAS6B.txt";
    $file = fopen($namaFile, "a");
    $konten = $studio . "|" . $judul_film . "|" . $jam_tayang . "|" . $jml_tiket . "|" .
        $jml_makan  . "|" . $jml_minum . "|" . $bayar_tiket . "|" . $bayar_makan . "|" .
        $bayar_minum . "|" . $total . "\n";

    fwrite($file, $konten);

    fclose($file);

    $isiFilePemesanan = file("TUGAS6B.txt");

    foreach ($isiFilePemesanan as $key => $value) {
        $data = explode("|", $value);
        $array[] = $data;
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
        <h2 class="text-center">Pemograman Web 2 <br>Tugas Pertemuan 06<br>Nurdiansah</h2>
        <!-- Form -->
        <?php if (isset($_POST['submit'])) { ?>
            <div class="alert alert-success mt-3" role="alert">
                Berhasil di proses!
            </div>
        <?php } ?>
        <h3>Form Pembelian Tiket</h3>
        <form action="" method="POST">
            <div class="row">
                <!-- Form  1-->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            Pembelian Tiket Cinema
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="studio">Studio</label>
                                <br>
                                <select name="studio" id="" required>
                                    <option value="">Pilih Studio</option>
                                    <option value="Studio 1">Studio 1</option>
                                    <option value="Studio 2">Studio 2</option>
                                    <option value="Studio 3">Studio 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jam Tayang</label><br>
                                <input type="radio" name="jam_tayang" value="10.00 - 12.00"> 10.00 - 12.00
                                <input type="radio" name="jam_tayang" value="13.00 - 15.00"> 13.00 - 15.00
                                <input type="radio" name="jam_tayang" value="16.00 - 18.00"> 16.00 - 18.00
                            </div>
                            <div class="form-group">
                                <input type="number" name="jml_tiket" placeholder="Jumlah Beli Tiket">
                            </div>
                            <b>Pembelian Tambahan</b>
                            <div class="form-group">
                                <input type="checkbox" name="makan" id=""> Makan
                                <input type="number" name="jml_makan" placeholder="Jumlah Beli">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="minum" id=""> Minum
                                <input type="number" name="jml_minum" placeholder="Jumlah Beli">
                            </div>
                            <button type="submit" name="submit" class="btn bg-primary mt-2 mb-2 float-right"> Proses </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Endform -->

        <?php if (isset($_POST['submit'])) { ?>
            <!-- Table -->
            <div class="col-sm-12 col-md-12 mt-5">
                <table class="table table-striped">
                    <caption>Daftar Pemesanan Tiket Cinema</caption>
                    <thead>
                        <tr>
                            <td>STUDIO</td>
                            <td>Judul Film</td>
                            <td>Jam Tayang</td>
                            <td>Jml Tiket</td>
                            <td>Jml Beli Makan</td>
                            <td>Jml Beli Minum</td>
                            <td>Bayar Tiket</td>
                            <td>Bayar Makan</td>
                            <td>Bayar Minum</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;
                        $totalTiket = 0;
                        foreach ($array as $key => $value) { ?>
                            <tr>
                                <td><?= $value[0]; ?></td>
                                <td><?= $value[1]; ?></td>
                                <td><?= $value[2]; ?></td>
                                <td><?= $value[3]; ?></td>
                                <td><?= $value[4]; ?></td>
                                <td><?= $value[5]; ?></td>
                                <td><?= 'Rp. ' . number_format($value[6], 0, ",", "."); ?></td>
                                <td><?= 'Rp. ' . number_format($value[7], 0, ",", "."); ?></td>
                                <td><?= 'Rp. ' . number_format($value[8], 0, ",", "."); ?></td>
                                <td><?= 'Rp. ' . number_format($value[9], 0, ",", "."); ?></td>
                            </tr>
                        <?php
                            $grandTotal += $data[9];
                            $totalTiket += $data[3];
                        }
                        ?>
                        <tr>
                            <td class="text-right" colspan="9">Jumlah Pendapatan Seluruhnya </td>
                            <td><b><?= 'Rp. ' . number_format($grandTotal, 0, ",", "."); ?></b></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="9">Jumlah Tiket Terjual </td>
                            <td><b><?= $totalTiket; ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Endtable -->
        <?php } ?>

        <h3 class="mt-5">Pilihan Film Terbaru</h3>
        <div class="row">
            <div class="col-sm-4 mb-2">
                <div class="card" style="width: 100%;">
                    <img src="assets/extraction.jpg" height="400px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Extraction</h5>
                        <p class="card-text">Studio 1</p>
                        <a href="#" class="btn btn-primary">Rp.70.000</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card" style="width: 100%;">
                    <img src="assets/bloodshot.jpeg" height="400px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Bloodshot</h5>
                        <p class="card-text">Studio 2</p>
                        <a href="#" class="btn btn-primary">Rp.70.000</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card" style="width: 100%;">
                    <img src="assets/bad.jpg" height="400px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Bad</h5>
                        <p class="card-text">Studio 3</p>
                        <a href="#" class="btn btn-primary">Rp.70.000</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
                    <div class="card-header">Makan</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp.50.000</h5>
                        <p class="card-text">Tambahan makanan untuk menemani menonton film kamu bareng si dia .</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-white bg-success mb-3" style="max-width: 30rem;">
                    <div class="card-header">Minum</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp.30.000</h5>
                        <p class="card-text">Tambahan minum untuk menemani menonton film kamu bareng si dia .</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>