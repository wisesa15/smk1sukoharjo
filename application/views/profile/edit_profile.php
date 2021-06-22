<div class="dashboard-wrapper ">
    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Edit Profile</h1>
        <div class="row">
            <!-- edit form column -->
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <form class="form-horizontal" action="<?= base_url('profile/editprofile'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-8">
                            <img src="<?= base_url('assets/images/profile/') . $user['image'] ?>" class="img-thumbnail mb-3" alt="avatar">
                            <input type="file" class="text-center center-block well well-sm" name="image" id="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">username :</label>
                        <div class="col-md-8">
                            <input class="form-control" name="username" value="<?= $user['username']; ?>" id="username" type="text">
                        </div>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
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