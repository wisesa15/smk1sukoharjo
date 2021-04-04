<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="container-fluid ">
                    <div class="card">
                        <div class="card-horizontal m-2">
                            <div class="card-header">
                                <h1><?= $title; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content mt-2.5 ml-2 ">
                            <?php $i = 0; ?>
                            <?php foreach ($aktivitas as $judul_pertemuan) : ?>
                                <hr class="mb-0">
                                <h1 class="card-header text-center"><?= $judul_pertemuan['nama_kegiatan']; ?></h1>
                                <hr class="mt-0 mb-0">
                                <div>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($file[$i] as $nama_materi) : ?>
                                            <?php if ($nama_materi['tgl_ditampilkan'] < time()) : ?>
                                                <?php if ($nama_materi['jenis'] == 1) : ?>
                                                    <li class="list-group-item">
                                                        <a href="<?= base_url('kelas/detailMateri/') . $nama_materi['id']; ?>">
                                                            <h3 style="display :inline;"><i class="fas fa-print mr-2"></i>
                                                                <?= $nama_materi['nama']; ?>
                                                            </h3>
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item ">
                                                        <a href="<?= base_url('kelas/detailMateri/') . $nama_materi['id']; ?>">
                                                            <h3 style="display :inline;"><i class="fas fa-tasks mr-2"></i>
                                                                <?= $nama_materi['nama']; ?>
                                                            </h3>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>


                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <hr>
                                    </ul>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>