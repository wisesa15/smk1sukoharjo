<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Tambah Siswa</h2>
                    <!-- <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                                vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p> -->
                    <!-- <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard
                                            Template</li>
                                    </ol>
                                </nav>
                            </div> -->
                    <hr>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- content  -->
        <!-- ============================================================== -->
        <form action="<?= base_url('siswa/tambah'); ?>" method="POST">
            <div class="form-group">
                <label for="nis">Nomor Induk Sekolah</label>
                <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS">
                <?= form_error('nis') ?>
            </div>
            <div class="form-group">
                <label for="nis">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                <?= form_error('nama') ?>
            </div>
            <div class=" form-group">
                <label for="jurusan">Jurusan</label>
                <div class="invalid-feedback"><?= form_error('jurusan'); ?></div>
                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan">
                <?= form_error('jurusan') ?>
            </div>
            <div class=" form-group">
                <label for="tahun-masuk">Tahun Masuk</label>
                <div class="invalid-feedback"><?= form_error('tahun-masuk'); ?></div>
                <input type="number" class="form-control" id="tahun-masuk" name="tahun-masuk" placeholder="Tahun Masuk">
                <?= form_error('tahun-masuk') ?>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="<?= base_url('siswa') ?>" class="btn btn-secondary">Batalkan</a>
        </form>
        <!-- ============================================================== -->
        <!-- End content  -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <div class="footer" style="margin-top: 95%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    Copyright © <?= date('Y'); ?> SMK 1 Sukoharjo. All rights reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->