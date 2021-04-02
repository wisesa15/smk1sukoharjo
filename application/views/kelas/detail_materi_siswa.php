<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="container-fluid">
                    <div class="jumbotron my-4 bg-white">
                        <h1 class="mb-0  display-4"><?= $file['nama']; ?></h1>
                        <hr class="mt-0 mb-3">
                        <div class="lead"><?= $file['keterangan'] ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('assets/file/') . $file['nama_file']; ?>" class="btn btn-primary btn-lg ml-3"><i class="fas fa-download"></i>
                <p>Download Materi</p>
            </a>
            <?php if ($user['role_id'] == 3 and $check == null) : ?>
                <?php if ($file['jenis'] == 2) : ?>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url('kelas/detailMateri/') . $file['id']; ?>">
                        <div class="container-fluid from-group">
                            <div class="mt-5 col-md-3 control-label file-loading">
                                <label class="control-label" for="file">File:<input type="file" name="userfile" size="20"></label>
                            </div>
                            <button type="submit" class="ml-2 btn btn-success"><i class="fas fa-file-upload"></i> UPLOAD</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php elseif ($user['role_id'] == 2) : ?>
                <?php if ($file['jenis'] == 2) : ?>
                    <button type="submit" class="ml-2 btn btn-success"><i class="fas fa-file-upload"></i> DOWNLOAD</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>