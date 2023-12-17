<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css\mycss.css" type="text/css">

    <title>Daftar Beasiswa</title>
</head>

<body>
    <?php
    include_once("connection.php");

    $result = mysqli_query($conn, "SELECT * FROM pendaftar");

    // Deteksi apakah ada parameter link page yang dikirimkan jika ada maka variabel link page akan diisi dari parameter tersebut
    if (isset($_GET['link_page'])) {
        $link_page = $_GET['link_page'];
    } else {
        $link_page = "1";
    }

    // Function digunakan untuk menentukan link yang aktif
    function SetLinkPage($actual_link, $reference_link)
    {
        $result = "";
        if ($actual_link == $reference_link) {
            $result = "show active";
        }
        return $result;
    }

    // Digunakan untuk menentukan content yang aktif
    function SetContentPage($actual_content, $reference_content)
    {
        $result = "";
        if ($actual_content == $reference_content) {
            $result = "show active";
        }
        return $result;
    }

    // Function untuk menGenerate bilangan random untuk nilai IPK
    function generateRandomFloat(float $minValue, float $maxValue): float
    {
        return $minValue + mt_rand() / mt_getrandmax() * ($maxValue - $minValue);
    }

    // Function yang digunakan untuk menentukan jenis beasiswa
    function setBeasiswa($actual_beasiswa, $reference_beasiswa)
    {
        $result = "";
        if ($actual_beasiswa == $reference_beasiswa) {
            $result = "selected";
        }
        return $result;
    }

    // Deteksi jenis beasiswa yang dipilih dari halaman sebelumnya
    if (isset($_GET['jenis_beasiswa'])) {
        $jenis_beasiswa = $_GET['jenis_beasiswa'];
    } else {
        $jenis_beasiswa = "akademik";
    }

    // Pengaturan Disable komponen jika ipk kurang dari 3
    function SetDisable($ipk)
    {
        $result = "";
        if ($ipk < 3) {
            $result = "disabled";
        }
        return $result;
    }
    ?>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Pendaftaran Beasiswa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div> <!-- end of container -->

    <!-- Nav Item -->
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-item nav-link <?php echo SetLinkPage("1", $link_page) ?>" id="nav-beasiswa-tab"
                    data-toggle="tab" href="#beasiswa" role="tab" aria-controls="beasiswa" aria-selected="true">Pilihan
                    Beasiswa</button>
                <button class="nav-item nav-link <?php echo SetLinkPage("2", $link_page) ?>" id="nav-daftar-tab"
                    data-toggle="tab" href="#daftar" role="tab" aria-controls="daftar"
                    aria-selected="false">Daftar</button>
                <button class="nav-link nav-link <?php echo SetLinkPage("3", $link_page) ?>" id="nav-hasil-tab"
                    data-toggle="tab" href="#hasil" role="tab" aria-controls="hasil"
                    aria-selected="false">Hasil</button>
            </div>
        </nav> <!-- End Nav Item -->


        <div class="tab-content" id="nav-tabContent">
            <!-- Jenis Content -->
            <div class="tab-pane fade <?php echo SetContentPage("1", $link_page) ?>" id="beasiswa" role="tabpanel"
                aria-labelledby="nav-beasiswa-tab">
                <div class="section-menu">
                    <h4>Jenis Beasiswa</h4>
                    <p>Beasiswa adalah dukungan finansial yang diberikan kepada individu untuk membantu biaya
                        pendidikan, dengan tujuan memberikan peluang kepada mereka yang memiliki potensi akademis atau
                        prestasi luar biasa, namun mungkin terbatas secara finansial. Beasiswa memainkan peran kunci
                        dalam meningkatkan akses pendidikan dan memberikan peluang kepada mereka yang tidak mampu
                        mengejar pendidikan tinggi tanpa dukungan keuangan. Beasiswa juga merupakan tunjangan bagi siswa
                        maupun mahasiswa dalam menuntut ilmu.</p>
                <div class="sides">
                    
                        <div class="card">
                            <h5>Beasiswa Akademik</h5>
                            <p> Beasiswa Akademik adalah beasiswa yang diberikan kepada pelajar atau mahasiswa
                                berprestasi. Beasiswa ini didasarkan pada rata-rata nilai sekolah menengah (IPK) dan
                                nilai ujian masuk perguruan tinggi (SAT/ACT). Beasiswa akademik merupakan bantuan atau
                                penghargaan untuk meringankan biaya belajar. Beasiswa akademik bertujuan untuk membantu
                                pelajar atau mahasiswa menyelesaikan pendidikannya sampai ke jenjang yang lebih tinggi.
                            </p>
                            <p> Persyaratan: </br>
                                1. Fotokopi Kartu Tanda Mahasiswa (KTM) dan Kartu Rencana Studi (KRS) atau dokumen lain
                                yang sejenis sebagai bukti mahasiswa aktif; </br>
                                2. Fotokopi transkrip nilai dengan Indeks Prestasi Kumulatif (IPK) minimal 3,00 pada
                                standar 4,00;</br>
                                3. Surat Rekomendasi dari pimpinan fakultas atau jurusan</br>
                                4. Scan KTP/Kartu Keluarga</br>
                                5. Pas photo warna terbaru </p>

                        <a class="btnbea"
                            href="index.php? link_page=2&jenis_beasiswa=akademik">Daftar Beasiswa Akademik</a>
                        </div>

                        <div class="card">
                            <h5>Beasiswa Non-Akademik</h5>
                            <p> Beasiswa Non-Akademik adalah beasiswa yang memberikan dukungan finansial untuk jalur
                                prestasi non-akademik, misalnya olahraga. Contoh cara mendapatkan beasiswa non-akademik
                                ialah dengan kamu memenangkan olimpiade tingkat nasional ataupun dunia suatu olahraga.
                                Biasanya pihak universitas yang akan menjadi pemberi beasiswa dengan tujuan agar bisa
                                mengharumkan nama institusi tersebut di kancah olahraga.</p>
                            <p> Persyaratan: </br>
                                1. Fotokopi Kartu Tanda Mahasiswa (KTM) dan Kartu Rencana Studi (KRS) atau dokumen lain
                                yang sejenis sebagai bukti mahasiswa aktif;</br>
                                2. Sertifikat Penghargaan Juara Bidang Olahraga</br>
                                3. Surat Rekomendasi dari pimpinan fakultas atau jurusan</br>
                                4. Scan KTP/Kartu Keluarga</br>
                                5. Pas photo warna terbaru </p>
                        
                        <a class="btnbea"
                            href="index.php? link_page=2&jenis_beasiswa=non_akademik">Daftar Beasiswa Non-Akademik</a>
                        </div>
                </div>
                </div>
            </div>

            <!-- Content Form -->
            <div class="tab-pane fade <?php echo SetContentPage("2", $link_page) ?>" id="daftar" role="tabpanel"
                aria-labelledby="nav-daftar-tab">
                <div class="section-menu">
                    <h4>Form Pendaftaran</h4>
                    <Form action="add_pendaftar.php" method="post" enctype="multipart/form-data">

                        <!-- Nama -->
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Nama"
                                    required>
                            </div>
                        </div> <!-- End Code Nama -->

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email"
                                    required>
                            </div>
                        </div> <!-- End Code Email -->

                        <!-- No hp -->
                        <div class="form-group row">
                            <label for="hp" class="col-sm-2 col-form-label">Nomor HP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="hp" name="hp" placeholder="Handphone"
                                    required>
                            </div>
                        </div> <!-- End code No hp-->

                        <!-- Alamat -->
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Address"
                                    required>
                            </div>
                        </div>

                        <!-- semester -->
                        <div class="form-group row">
                            <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="semester" id="semester" required>
                                    <?php
                                    for ($i = 1; $i <= 8; $i++) {
                                    ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> <!-- End code semester -->

                        <?php
                        $minValue = 2.9;
                        $maxValue = 3.4;
                        $ipk = round(generateRandomFloat($minValue, $maxValue), 1);
                        ?>

                        <!-- ipk -->
                        <div class="form-group row">
                            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                            <div class="col-sm-10">
                                <input type="" class="form-control" id="inputIpk" name="ipk" value="<?php echo $ipk ?>"
                                    required readonly>
                            </div>
                        </div>
                        <!-- end code IPK -->

                        <!-- Pilihan Beasiswa -->
                        <div class="form-group row">
                            <label for="beasiswa" class="col-sm-2 col-form-label">Pilih Beasiswa</label>
                            <div class="col-sm-10">

                                <select class="form-control" name="beasiswa" id="beasiswa" required
                                    <?php echo SetDisable($ipk) ?>>
                                    <option value="akademik" <?php echo setBeasiswa("akademik", $jenis_beasiswa) ?>>
                                        Akademik</option>
                                    <option value="non_akademik"
                                        <?php echo setBeasiswa("non_akademik", $jenis_beasiswa) ?>>Non-Akademik</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Code Pilihan Beasiswa-->

                        <!-- Upload File -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file_upload">Upload File</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="customFile" name="berkas" required
                                    <?php echo SetDisable($ipk) ?>>
                            </div>
                        </div>

                        <input class="btn btn-primary btn-lg" type="submit" id="tombolDaftar" value="Daftar"
                            <?php echo SetDisable($ipk) ?>>
                        <a class="btn btn-warning btn-lg" href="index.php?link_page=2">Batal</a>

                        </form>
                    </div>
                </div>
            <!-- end content form -->

            <!-- Hasil -->
            <div class="tab-pane fade <?php SetContentPage("3", $link_page) ?>" id="hasil" role="tabpanel"
                aria-labelledby="nav-contact-tab">
                <!-- <div class="section-menu"> -->
                <h4>List Pendaftar Beasiswa</h4>

                <?php
                include_once("connection.php");

                $results = mysqli_query($conn, "SELECT * FROM registrasi");
                
                while ($user_data = mysqli_fetch_assoc($results)) {
                    ?>
                <div class="row grid-item mt-3">
                    <div class="col-md-9 col-lg-8">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Nama: </h4>
                                <h5><?= $user_data['nama']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Email:</h4>
                                <h5><?= $user_data['email']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Nomor Hp: </h4>
                                <h5><?= $user_data['hp']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Alamat:</h4>
                                <h5><?= $user_data['alamat']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Semester:</h4>
                                <h5><?= $user_data['semester']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>IPK:</h4>
                                <h5><?= $user_data['ipk']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Pilihan Beasiswa:</h4>
                                <h5><?= $user_data['beasiswa']; ?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Status:</h4>
                                <h5><?= $user_data['status']; ?></h5>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <h4>Berkas : </h4>
                                <a href="uploads/<?= $user_data['berkas']; ?>"><?= $user_data['berkas']; ?> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
             
                ?>
            </div>
            </div> <!-- end of container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </div>
        <footer>
            <p>&copy; Beasiswa Pendidikan Tinggi 2023 by Alisya Mutia Mantika</p>
        </footer>
</body>
</html>