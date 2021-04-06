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
            <form class="form-horizontal" method="Post" action="<?= base_url('kelas/editPertemuan/') . $pertemuan['id']; ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nama Aktivitas </label>
                    <div class="col-lg-8">
                        <input class="form-control" value='<?= $pertemuan['nama_kegiatan']; ?>' name="newAktivitas" id="newAktivitas" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <span></span>
                        <a class="btn btn-warning" href="<?= base_url('kelas/detail/') . $kelasP['id_kelas']; ?>">cancel</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>