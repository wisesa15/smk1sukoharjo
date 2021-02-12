<div class="dashboard-wrapper ">
    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Edit Profile</h1>
        <div class="row">
            <!-- left column -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="text-center">
                    <img src="http://lorempixel.com/200/200/people/9/" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6>Upload a photo...</h6>
                    <input type="file" class="text-center center-block well well-sm">
                </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

                <h3>Personal info</h3>
                <form class="form-horizontal" action="<?= base_url('profile/edit'); ?>" method="POST">

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