<?php
include 'template/header.php';
include 'template/navbar.php';
?>

<!-- ===================== CONTENT ===================== -->
<div class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Alur Pendaftaran PMB</h2>
        <p class="text-muted">Proses pendaftaran mahasiswa baru Universitas</p>
    </div>

    <!-- STEP FLOW -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-5">

            <div class="position-relative">

                <!-- LINE -->
                <div class="position-absolute top-0 start-50 translate-middle-x h-100 border-start"></div>

                <!-- STEP ITEM -->
                <?php
                $steps = [
                    "Register Akun",
                    "Login ke Sistem",
                    "Dashboard Mahasiswa",
                    "Isi Formulir PMB",
                    "Upload Berkas",
                    "Menunggu Seleksi Admin",
                    "Pengumuman Hasil",
                    "Pembayaran UKT",
                    "Status Mahasiswa Aktif",
                    "OSPEK / Orientasi"
                ];

                foreach($steps as $i => $step){
                ?>

                <div class="row mb-4 align-items-center">

                    <?php if($i % 2 == 0){ ?>

                        <div class="col-5 text-end">
                            <div class="p-3 bg-light rounded-3 shadow-sm">
                                <?= $step ?>
                            </div>
                        </div>

                        <div class="col-2 text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center"
                                style="width:40px;height:40px;">
                                <?= $i+1 ?>
                            </div>
                        </div>

                        <div class="col-5"></div>

                    <?php } else { ?>

                        <div class="col-5"></div>

                        <div class="col-2 text-center">
                            <div class="bg-success text-white rounded-circle d-inline-flex justify-content-center align-items-center"
                                style="width:40px;height:40px;">
                                <?= $i+1 ?>
                            </div>
                        </div>

                        <div class="col-5 text-start">
                            <div class="p-3 bg-light rounded-3 shadow-sm">
                                <?= $step ?>
                            </div>
                        </div>

                    <?php } ?>

                </div>

                <?php } ?>

            </div>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>