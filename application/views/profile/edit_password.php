<div class="dashboard-wrapper ">
    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Edit Password</h1>
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <?= $this->session->flashdata('message'); ?>
                <form class="form-horizontal" action="<?= base_url('profile/editpassword'); ?>" method="POST">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Old Password :</label>
                        <div class="col-md-8">
                            <?= form_error('old_password'); ?>
                            <input class="form-control" name="old_password" id="old_password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>
                        <div class="col-md-8">
                            <?= form_error('password'); ?>
                            <input class="form-control" name="password" id="password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="n_password">Konfirmasi password:</label>
                        <div class="col-md-8">
                            <?= form_error('n_password'); ?>
                            <input class="form-control" name="n_password" id="n_password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                            <span></span>
                            <a class="btn btn-warning" href="<?= base_url('profile'); ?>">Batalkan</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>