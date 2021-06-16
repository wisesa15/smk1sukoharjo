<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-3"> Dashboard</h2>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <div class="container-fluid ">
                    <div class="card">
                        <div class="card-horizontal" style="height: 155px;">
                            <div class="row">
                                <div class="col-6 col-sm-3 ml-3 mt-3">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 ml-3 mt-3    ">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $guru['nama']; ?> </h4>
                                        <h4><?= $guru['nip']; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content mt-2.5 ml-2 ">
                            <h1 class="card-header mt-2.5 ml-2.5">Daftar Kelas</h1>
                            <hr class="mt-0">
                            <div class="neat ">
                                <div class="row">
                                    <?php $i = 1; ?>
                                    <?php foreach ($kelas as $k) : ?>
                                        <div class="col-md-4">
                                            <a href="<?= base_url('kelas/detail/') . $k['id'] ?>">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?= base_url('assets/images/kelas/') . $k['gambar']; ?>" alt="Gambar Kelas">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= $k['nama']; ?></h5>
                                                        <p><?= $k['tahun_ajaran']; ?></p>
                                                        <div>
                                                            <?php foreach ($pengajar[$i - 1] as $p) : ?>
                                                                <span class="badge badge-dark"><?= $p['nama']; ?></span>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>