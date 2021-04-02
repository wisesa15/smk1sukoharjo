<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <table class="table">
                <thead class="bg-light">
                    <tr class="border-0">
                        <th class="border-0">No</th>
                        <th class="border-0">Nama</th>
                        <th class="border-0">Sudah / Belum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($allSiswa as $siswa) : ?>
                        <tr>
                            <th class="border-0"><?= $i; ?></th>
                            <th class="border-0"><?= $siswa['nama']; ?></th>
                            <?php if ($siswa['status'] == 0) : ?>
                                <th class="border-0"> <span class="badge badge-danger btn-lg ml-3 p-3">Belum</span></th>
                            <?php else : ?>
                                <th class="border-0"> <a href="<?= base_url('assets/file/') . $siswa['materi']['nama_file']; ?>" class="badge badge-primary btn-lg ml-3 p-3">Sudah</a></th> <?php endif; ?>
                            <?php $i++; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>