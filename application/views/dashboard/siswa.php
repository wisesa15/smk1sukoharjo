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
                                        <h4 class="card-title"><?= $siswa['nama']; ?> </h4>
                                        <h4><?= $siswa['nis']; ?></h4>
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
                                    <?php foreach ($kelas as $k) : ?>
                                        <div class="col-md-4">
                                            <a href="<?= base_url('kelas/detail/') . $k['id'] ?>">
                                                <div class="card">
                                                    <img class="card-img-top" src="https://source.unsplash.com/random/800x600" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= $k['nama']; ?></h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <div class="next m-2">
                                <a href="#" class="btn btn-primary">next page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>