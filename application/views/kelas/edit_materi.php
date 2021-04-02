<div class="dashboard-wrapper ">
    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Tambah Materi</h1>
        <!-- tambah materi -->
        <div class="personal-info">
            <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Peringatan</strong>.Pastikan form yang anda isi sesuai dengan form requirement
            </div>
            <h3>Materi Info</h3>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url('kelas/editMateri/') . $file['id']; ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nama file</label>
                    <div class="col-lg-8">
                        <input class="form-control" placeholder="nama file yang ditampilkan" value="<?= $file['nama']; ?>" type="text" name="nama_file">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Jenis Materi</label>
                    <div class="col-lg-8">
                        <select id="inputState" class="form-control" name="jenis">
                            <?php if ($file['jenis'] == 1) : ?>
                                <option value="1" selected>Materi</option>
                                <option value="2">Tugas</option>
                            <?php elseif ($file['jenis'] == 2) : ?>
                                <option value="1">Materi</option>
                                <option value="2" selected>Tugas</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="summernote">Keterangan</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" id="summernote" name="keterangan" rows="6" value="<?= $file['keterangan']; ?>"><?= $file['keterangan']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tanggal ditampilkan:</label>
                    <input type="datetime-local" id="dataTampil" name="dataTampil" value="<?= date('Y-m-d\TH:i', $file['tgl_ditampilkan']); ?>">
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Dateline:</label>
                    <input type="datetime-local" id="dateline" name="dateline" value="<?= date('Y-m-d\TH:i', $file['tenggalwaktu']); ?>">
                </div>
                <div class="from-group">
                    <div class="col-md-3 control-label file-loading">
                        <label class="col-md-3 control-label" for="file">File:</label>
                        <input type="file" name="userfile" size="20" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <span></span>
                        <a class="btn btn-warning" href="<?= base_url('kelas/detail/') . $detailKelas['id']; ?>">cancel</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>