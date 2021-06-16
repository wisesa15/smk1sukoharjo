</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->


<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
<script src="<?= base_url(''); ?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="<?= base_url(''); ?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="<?= base_url(''); ?>assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!--  buat multiple select -->
<script src="<?= base_url(''); ?>assets/vendor/select2/js/select2.min.js"></script>
<!-- main js -->
<script src="<?= base_url(''); ?>assets/libs/js/main-js.js"></script>
<script src="<?= base_url('assets/vendor/'); ?>summernote/js/summernote-bs4.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300

        });
    });
</script>
<script>
    $('.hapus-siswa').on('click', function(event) {
        event.preventDefault();
        const idKelas = $(this).data('kelas');
        const idSiswa = $(this).data('siswa');

        $.ajax({
            url: "<?= base_url('kelas/hapussiswa') ?>",
            type: "post",
            data: {
                idKelas: idKelas,
                idSiswa: idSiswa
            },
            success: function() {
                document.location.href = "<?= base_url('kelas/atursiswa/') ?>" + idKelas;
            }
        })
    });
</script>
<script>
    $('.hapus-guru').on('click', function(event) {
        event.preventDefault();
        const idKelas = $(this).data('kelas');
        const idGuru = $(this).data('guru');

        $.ajax({
            url: "<?= base_url('kelas/hapusguru') ?>",
            type: "post",
            data: {
                idKelas: idKelas,
                idGuru: idGuru
            },
            success: function() {
                document.location.href = "<?= base_url('kelas/aturguru/') ?>" + idKelas;
            }
        })
    });
</script>
<!-- datatables js -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<!-- chart chartist js -->
<!-- <script src="<?= base_url(''); ?>assets/vendor/charts/chartist-bundle/chartist.min.js"></script> -->
<!-- sparkline js -->
<!-- <script src="<?= base_url(''); ?>assets/vendor/charts/sparkline/jquery.sparkline.js"></script> -->
<!-- morris js -->
<!-- <script src="<?= base_url(''); ?>assets/vendor/charts/morris-bundle/raphael.min.js"></script>
<script src="<?= base_url(''); ?>assets/vendor/charts/morris-bundle/morris.js"></script> -->
<!-- chart c3 js -->
<!-- <script src="<?= base_url(''); ?>assets/vendor/charts/c3charts/c3.min.js"></script>
<script src="<?= base_url(''); ?>assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
<script src="<?= base_url(''); ?>assets/vendor/charts/c3charts/C3chartjs.js"></script>
<script src="<?= base_url(''); ?>assets/libs/js/dashboard-ecommerce.js"></script>  -->
</body>

</html>