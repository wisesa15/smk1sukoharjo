<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="container-fluid">
                    <div class="card ">
                        <h1 class="card-header text-center"><?= $file['nama']; ?>
                            <?php if ($file['jenis'] == 2) : ?>
                                <?php if ($user['role_id'] == 3 and $check != null) : ?>
                                    <span class="badge badge-success">Sudah Mengumpulkan</span>
                                <?php elseif ($user['role_id'] == 3 and $check == null and  $file['tenggalwaktu'] < time()) : ?>
                                    <span class="badge badge-danger">Telat Mengumpulkan</span>
                                <?php elseif ($user['role_id'] == 3 and $check == null and  $file['tenggalwaktu'] >= time()) : ?>
                                    <span class="badge badge-warning">Belum Mengumpulkan</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </h1>
                        <?php if ($file['jenis'] == 2) : ?>
                            <span style="background-color:#F3B600; text-align:center; color:black; ">Tenggat Waktu : <?= date('d/m/Y H:i', $file['tenggalwaktu']); ?></span>
                        <?php endif; ?>
                        <hr class="mt-0 mb-3">
                        <div class="card-body"><?= $file['keterangan'] ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('assets/file/') . $file['nama_file']; ?>" class="badge badge-primary btn-lg ml-3 p-3"><i class="fa-fw fas fa-download"></i>
                <p>Download Materi</p>
            </a>
            <div class="mt-3"><?= $this->session->flashdata('message') ?> </div>
            <?php if ($user['role_id'] == 3 and $check == null and $file['tenggalwaktu'] >= time()) : ?>
                <?php if ($file['jenis'] == 2) : ?>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url('kelas/detailMateri/') . $file['id']; ?>">
                        <div class="container-fluid from-group">
                            <div class="mt-5 col-md-3 control-label file-loading">
                                <label class="control-label" for="file">File:<input type="file" name="userfile" size="20" required=""></label>
                            </div>
                            <button type="submit" class="ml-2 btn btn-success"><i class="fas fa-file-upload"></i> UPLOAD</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php elseif ($user['role_id'] == 2) : ?>
                <?php if ($file['jenis'] == 2) : ?>
                    <a href="<?= base_url('kelas/masterFile/') . $file['id']; ?>" type="submit" class="ml-2 badge badge-success ml-3 p-3"><i class="fa-fw fas fa-file-upload"></i><br> DOWNLOAD HASIL</a>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>