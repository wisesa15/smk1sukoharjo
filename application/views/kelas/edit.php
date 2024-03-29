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
                    <h2 class="pageheader-title">Tambah Kelas</h2>
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
        <div class="col-lg-8">
            <?= $this->session->flashdata('message') ?>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- content  -->
        <!-- ============================================================== -->
        <form action="<?= base_url('kelas/ubah/') . $kelas['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-lg-8">
                    <label for="nis">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $kelas['nama'] ?>">
                    <?= form_error('nama'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-8">
                    <label for="gambar">Gambar</label></br>
                    <input type="file" class="text-center center-block well well-sm" name="gambar" id="gambar">
                </div>
            </div>
            <div class="col-lg-8">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="<?= base_url('kelas') ?>" class="btn btn-secondary">Batalkan</a>
            </div>
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