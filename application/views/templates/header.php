<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?= base_url(''); ?>assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/libs/css/style.css">
    <!-- <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css"> -->
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/fonts/fontawesomenew/css/all.css">
    <!-- <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/fonts/flag-icon-css/flag-icon.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/select2/css/select2.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/inputmask/css/inputmask.css">
    <!-- Summenote -->
    <link href="<?= base_url('assets/vendor/'); ?>summernote/css/summernote-bs4.css" rel="stylesheet">
    <!-- Datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title><?= $title; ?></title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <!-- Judul -->
                <img class="ml-3" style="height: 2.5em;" src="<?= base_url('assets/images/logo/logo-128.png'); ?>"></img>
                <a class="navbar-brand" href="index.html">SMK N 1 SUKOHARJO</a>
                <!-- Tombol to see profile when navbar collapsed -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Profile -->
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('/assets/images/profile/') . $user['image']; ?>" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?= $user['username']; ?></h5>
                                </div>
                                <a class="dropdown-item" href="<?= base_url('profile'); ?>"><i class="fas fa-user mr-2"></i>My Profile</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->

        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT `user_menu`.`id`, `menu`, `url`, `icon` FROM `user_menu` JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id` WHERE `user_access_menu`.`role_id` = $role_id ORDER BY `user_access_menu`.`menu_id` ASC";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#"><?= $title; ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <?php if ($user['role_id'] == 1) : ?>
                                <?php foreach ($menu as $m) : ?>
                                    <li class="nav-item ">
                                        <?php if ($title == $m['menu']) : ?>
                                            <a class="nav-link active" href="<?= base_url($m['url']); ?>">
                                            <?php else : ?>
                                                <a class="nav-link" href="<?= base_url($m['url']); ?>">
                                                <?php endif; ?>
                                                <i class="<?= $m['icon']; ?>"></i><?= $m['menu']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php foreach ($menu as $m) : ?>
                                    <li class="nav-item ">
                                        <?php if ($title == $m['menu'] && $m['menu'] != 'Kelas') : ?>
                                            <a class="nav-link active" href="<?= base_url($m['url']); ?>">
                                                <i class="<?= $m['icon']; ?>"></i><?= $m['menu']; ?></a>
                                        <?php elseif ($m['menu'] == 'Kelas') : ?>
                                            <a class="nav-link" href="" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                                                <i class="<?= $m['icon']; ?>"></i><?= $m['menu']; ?></a>
                                            <div id="submenu-2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <?php foreach ($kelas as $k) : ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="<?= base_url('kelas/detail/') . $k['id']; ?>"><?= $k['nama']; ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php else : ?>
                                            <a class="nav-link" href="<?= base_url($m['url']); ?>">
                                                <i class="<?= $m['icon']; ?>"></i><?= $m['menu']; ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->