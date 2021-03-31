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
                    <h2 class="pageheader-title">Kelas</h2>
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
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">

                        <a href="<?= base_url('kelas/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Kelas</a>
                    </div>
                    <?= $this->session->flashdata('message') ?>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Nama Pengajar</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kelas as $k) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><a href="<?= base_url('kelas/detail/') . $k['id']; ?>"><?= $k['nama']; ?></a></td>
                                    <td>
                                        <?php foreach ($pengajar[$i - 1] as $p) : ?>
                                            <a href="<?= base_url('guru/detail/') . $p['id']; ?>" class="badge badge-light"><?= $p['nama']; ?></a>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <a href="#" class="badge badge-success">Edit</a>
                                        <a href="#" class="badge badge-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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