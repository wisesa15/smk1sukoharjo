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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="d-flex justify-content-end">

                        <a href="<?= base_url('kelas/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Kelas</a>
                    </div>
                    <?= $this->session->flashdata('message') ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kelas</th>
                                            <th scope="col">Nama Pengajar</th>
                                            <th scope="col">Tahun Ajaran</th>
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
                                                        <a href="<?= base_url('guru/detail/') . $p['id']; ?>" class="badge badge-dark"><?= $p['nama']; ?></a>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td><?= $k['tahun_ajaran']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('kelas/atursiswa/') . $k['id']; ?>" class="badge badge-primary">Atur Siswa</a>
                                                    <a href="<?= base_url('kelas/aturguru/') . $k['id']; ?>" class="badge badge-primary">Atur Guru</a>
                                                    <a href="<?= base_url('kelas/ubah/') . $k['id']; ?>" class="badge badge-success">Ubah</a>
                                                    <a href="<?= base_url('kelas/hapus/') . $k['id']; ?>" class="badge badge-danger">Hapus</a>
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