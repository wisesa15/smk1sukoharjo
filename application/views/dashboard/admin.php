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
                    <h2 class="pageheader-title">Dashboard</h2>
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
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Jumlah Siswa</h5>
                            <div>
                                <h1 class="mb-1"><?= $this->db->count_all_results('siswa'); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Jumlah Guru</h5>
                            <div>
                                <h1 class="mb-1"><?= $this->db->count_all_results('guru'); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Jumlah Kelas</h5>
                            <div>
                                <h1 class="mb-1"><?= $this->db->count_all_results('kelas'); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="image-fluid">
                            <img class="img-fluid card-img-top" src="<?= base_url('/assets/images/logo/depan.png'); ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">SMK 1 SUKOHARJO</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End content  -->
            <!-- ============================================================== -->
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->