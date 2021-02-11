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
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nama Aktivitas </label>
                    <div class="col-lg-8">
                        <input class="form-control" value="activity_name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nama file</label>
                    <div class="col-lg-8">
                        <input class="form-control" value="file_name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Jenis Materi</label>
                    <div class="col-lg-8">
                        <select id="inputState" class="form-control">
                            <option value="1" selected>Materi</option>
                            <option value="2">Tugas</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tanggal ditampilkan:</label>
                    <input type="date" id="date_insert" name="date_insert">
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Dateline:</label>
                    <input type="date" id="dateline" name="dateline">
                </div>
                <div class="from-group">
                    <div class="col-md-3 control-label file-loading">
                        <input id="input-b7" name="input-b7[]" multiple type="file" class="file" data-allowed-file-extensions='["csv", "txt"]'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input class="btn btn-primary" value="Save Changes" type="button">
                        <span></span>
                        <input class="btn btn-default" value="Cancel" type="reset">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>