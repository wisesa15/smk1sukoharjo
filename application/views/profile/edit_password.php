<div class="dashboard-wrapper ">
    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Edit Password</h1>
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <form class="form-horizontal" action="<?= base_url('profile/editpassword'); ?>" method="POST">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Old Password :</label>
                        <div class="col-md-8">
                            <input class="form-control" name="old_password" id="old_password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="password" id="password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="n_password">Confirm password:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="n_password" id="n_password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <span></span>
                            <a class="btn btn-warning" href="<?= base_url('profile'); ?>">cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>