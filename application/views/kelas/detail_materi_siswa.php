<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="container-fluid">
                    <div class="jumbotron my-4 bg-white">
                        <h1 class="mb-0  display-4"><?= $fle['nama']; ?></h1>
                        <hr class="mt-0 mb-3">
                        <div class="lead"><?= $file['keterangan'] ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('assets/file/') . $file['nama_file']; ?>" class="btn btn-primary btn-lg ml-3"><i class="fas fa-download"></i>
                <p>Download Materi</p>
            </a>
        </div>
    </div>
</div>