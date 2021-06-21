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
                    <h2 class="pageheader-title">Guru</h2>
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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="d-flex justify-content-end">

                        <a href="<?= base_url('guru/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Guru</a>
                    </div>
                    <?= $this->session->flashdata('message') ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIP</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($guru as $s) : ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nip']; ?></td>
                                                <td><a href="<?= base_url('guru/detail/') . $s['id']; ?>"><?= $s['nama']; ?></a></td>
                                                <td>
                                                    <a href="<?= base_url('guru/ubah/') . $s['id']; ?>" class="badge badge-success">Ubah</a>
                                                    <a href="<?= base_url('guru/hapus/') . $s['id']; ?>" class="badge badge-danger">Hapus</a>
                                                    <a href="<?= base_url('auth/resetpassword/2/') . $s['id']; ?>" class="badge badge-dark">Reset Password</a>
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