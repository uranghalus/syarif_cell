<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                            <div class="col-12">
                                <img src="<?= base_url('public/uploads/' . $data_perangkat['gambar']) ?>" class="product-image" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3"><?= $data_perangkat['nama_perangkat'] ?></h3>
                            <p><?= $data_perangkat['deskripsi'] ?></p>

                            <hr>
                            <h4><?= $data_perangkat['nama_merek'] ?></h4>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <?php if (empty($data_spesifikasi)) : ?>
                                        <p class="text-center font-weight-bold text-muted">Spesifikasi Tidak Ada</p>
                                    <?php else : ?>
                                        <dl class="row">
                                            <?php foreach ($data_spesifikasi as $spesifikasi) : ?>
                                                <dt class="col-sm-4 mb-3"><?= $spesifikasi['jenis_spesifikasi'] ?></dt>
                                                <dd class="col-sm-8"><?= $spesifikasi['nilai_spesifikasi'] ?></dd>
                                            <?php endforeach ?>
                                        </dl>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    <?= "Rp " . number_format($data_perangkat['harga'], 0, ',', '.'); ?>
                                </h2>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary btn-lg btn-flat" id="add-to-cart" data-id="<?= $data_perangkat['perangkat_id'] ?>">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    Add to Cart
                                </button>
                                <div class="btn btn-default btn-lg btn-flat">
                                    <i class="fas fa-heart fa-lg mr-2"></i>
                                    Add to Wishlist
                                </div>
                            </div>

                            <!-- <div class="mt-4 product-share">
                                <a href="#" class="text-gray">
                                    <i class="fab fa-facebook-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fab fa-twitter-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fas fa-envelope-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fas fa-rss-square fa-2x"></i>
                                </a>
                            </div> -->

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<!--LINK JS -->
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#add-to-cart').on('click', function() {
            var id = $(this).data('id');
            <?php $isLoggedIn = session()->get('logged_in') ?>
            <?php if (!$isLoggedIn) : ?>
                Toast.fire({
                    icon: 'error',
                    title: "anda harus login dahulu"
                }).then(() => {
                    window.location.href = "<?= base_url("/auth/login") ?>";
                })
            <?php else : ?>
                $.ajax({
                    url: '<?= base_url('/client/cart/add/') ?>' + id,
                    method: 'GET',
                    success: function(response) {
                        var data = response;
                        (data.res == "success") ?
                        Toast.fire({
                                icon: 'success',
                                title: data.message
                            }).then(() => {
                                location.reload();
                            }):
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            }).then(() => {
                                location.reload();
                            });
                    }
                });
            <?php endif ?>

        })
    })
</script>
<?= $this->endSection() ?>