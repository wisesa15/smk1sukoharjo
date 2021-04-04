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
                    <h2 class="pageheader-title"><?= $title; ?></h2>
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
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="bg-white mb-4">
                    <h3 class="text-center p-3"><?= $infokelas['nama'] ?></h3>
                </div>
                <div class="card">
                    <h5 class="card-header">Daftar Siswa</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $daftar_siswa = array(); ?>
                                <?php foreach ($kelas_siswa as $ks) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $ks['nama'] ?></td>
                                        <td><a href="#" class="badge badge-danger hapus-siswa" data-siswa="<?= $ks['id'] ?>" data-kelas="<?= $infokelas['id'] ?>">Hapus</a></td>
                                        <?php array_push($daftar_siswa, $ks['id']); ?>
                                        <?php $i = $i + 1 ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Tambah Siswa</h5>
                    <div class="card-body">
                        <form action="<?= base_url('kelas/atursiswa/') . $infokelas['id']; ?>" method="POST">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Siswa</label>
                                <div class="invalid-feedback"><?php echo form_error('siswa'); ?></div>
                                <div class="col-md-12">
                                    <select class="js-example-basic-multiple" multiple="multiple" name="siswa[]">
                                        <!-- <option value="" selected></option> -->
                                        <?php foreach ($siswa as $s) : ?>
                                            <?php if (!in_array($s['id'], $daftar_siswa)) : ?>
                                                <option value="<?= $s['id']; ?>"><?= $s['nis']; ?> - <?= $s['nama']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a href="<?= base_url('kelas') ?>" class="btn btn-secondary">Batalkan</a>
                            </div>
                        </form>
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