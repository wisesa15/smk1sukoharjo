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
                    <h2 class="pageheader-title">Data Siswa</h2>
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

        <div>
            <!-- ============================================================== -->
            <!-- content  -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end">

                        <a href="<?= base_url('siswa/tambah'); ?>" class="btn btn-primary mb-3">+ Tambah Siswa</a>
                    </div>
                    <?= $this->session->flashdata('message') ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Tahun Masuk</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($siswa as $s) : ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nis']; ?></td>
                                                <td><a href="<?= base_url('siswa/detail/') . $s['id']; ?>"><?= $s['nama']; ?></a></td>
                                                <td><?= $s['jurusan']; ?></td>
                                                <td><?= $s['tahun_masuk']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('siswa/ubah/') . $s['id']; ?>" class="badge badge-success">Ubah</a>
                                                    <a href="<?= base_url('siswa/hapus/') . $s['id']; ?>" class="badge badge-danger">Hapus</a>
                                                    <a href="<?= base_url('auth/resetpassword/3/') . $s['id']; ?>" class="badge badge-dark">Reset Password</a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End content  -->
            <!-- ============================================================== -->
        </div>
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