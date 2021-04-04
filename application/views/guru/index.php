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
                                <table class="table table-striped table-bordered first">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIP</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = $page * 20 + 1; ?>
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
                            <nav aria-label="Page navigation example" class="pt-5">
                                <ul class="pagination">
                                    <?= $links; ?>
                                </ul>
                            </nav>
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
                        Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
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