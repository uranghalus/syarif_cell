<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="py-5 text-center">
        <h2><?= $title ?></h2>
        <p class="lead">Nikmati proses checkout yang cepat dan aman. Tinjau kembali item-item Anda, lakukan pembayaran, dan selesaikan pembelian dengan mudah. Jika ada pertanyaan, tim layanan pelanggan kami siap membantu!</p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill" id="cartItemCount">0</span>
            </h4>
            <ul class="list-group mb-3" id="cartItemsList">
                <!-- Cart items will be appended here dynamically -->
                <?php foreach ($cart_data as $item) : ?>
                    <li class="list-group-item" id="cartItem<?= $item['id'] ?>">
                        <div class="d-flex justify-content-between lh-condensed">
                            <input type="checkbox" class="itemCheckbox" data-perangkat="<?= $item['perangkat_id'] ?>" data-id="<?= $item['id'] ?>" checked>
                            <span class="text-muted itemPrice" id="itemPrice<?= $item['id'] ?>" data-original-price="<?= $item['harga'] ?>">Rp. <?= $item['harga'] ?></span>
                        </div>
                        <div class="">
                            <h6 class="my-0 mb-2"><?= $item['nama_perangkat'] ?></h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted itemQuantity mr-auto" id="displayQuantity<?= $item['id'] ?>"><?= $item['quantity'] ?></small>
                                <div class="ml-2 input-group w-25">
                                    <button class="btn btn-warning btn-sm btn-minus" data-id="<?= $item['id'] ?>">-</button>
                                    <input type="text" class="form-control form-control-sm itemQuantity" id="quantity<?= $item['id'] ?>" value="<?= $item['quantity'] ?>" readonly>
                                    <button class="btn btn-warning btn-sm btn-plus" data-id="<?= $item['id'] ?>">+</button>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong id="totalPrice">0</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Alamat Pengiriman</h4>
            <form id="checkout-form" class="needs-validation">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="nama-penerima">Nama Penerima</label>
                            <input type="text" name="nama" class="form-control" id="nama-penerima" value="<?= session()->get('name') ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= session()->get('email') ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" value="<?= session()->get('alamat') ?>" readonly>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Nomor Telpon</label>
                    <input type="text" class="form-control" id="address2" value="<?= session()->get('nomor_telpon') ?>" readonly>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Pembayaran</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="credit" name="metode_pembayaran" type="radio" value="COD" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">COD</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="debit" name="metode_pembayaran" type="radio" value="Transfer" class="custom-control-input" required>
                        <label class="custom-control-label" for="debit">Transfer Rekening</label>
                    </div>
                </div>
                <hr class="mb-4">
                <button id="checkout-btn" class="btn btn-primary btn-lg btn-block" type="button">Continue to checkout</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Fungsi untuk menghitung total harga berdasarkan item yang dipilih

        function updateTotalPrice() {
            var totalPrice = 0;
            var cartItemCount = 0;
            $('.itemCheckbox:checked').each(function() {
                var itemId = $(this).data('id');
                var price = parseFloat($('#itemPrice' + itemId).text().replace('Rp.', ''));
                var quantity = parseInt($('#quantity' + itemId).val());
                totalPrice += price;
                cartItemCount++;
            });
            $('#totalPrice').text('Rp. ' + totalPrice.toFixed(2));
            $('#cartItemCount').text(cartItemCount);
        }

        // Panggil fungsi untuk pertama kali saat halaman dimuat
        updateTotalPrice();

        // Tambahkan event listener untuk perubahan checkbox
        $(document).on('change', '.itemCheckbox', function() {
            updateTotalPrice();
        });

        // Tambahkan event listener untuk perubahan jumlah quantity
        $(document).on('input', '.itemQuantity', function() {
            updateTotalPrice();
        });

        // Event listener untuk tombol plus
        $(document).on('click', '.btn-plus', function() {
            var itemId = $(this).data('id');
            var quantityInput = $('#quantity' + itemId);
            var displayQuantity = $('#displayQuantity' + itemId);
            var itemPriceElement = $('#itemPrice' + itemId); // Ambil elemen harga
            var itemPrice = itemPriceElement.data('original-price');
            var currentQuantity = parseInt(quantityInput.val());
            quantityInput.val(currentQuantity + 1);
            displayQuantity.text(currentQuantity + 1); // Perbarui tampilan jumlah
            // Perbarui harga dengan mengalikan harga per item dengan jumlah baru
            var price = parseFloat(itemPrice);
            itemPriceElement.text('Rp.' + (price * (currentQuantity + 1)).toFixed(2));

            updateTotalPrice();
        });
        // Event listener untuk tombol minus
        $(document).on('click', '.btn-minus', function() {
            var itemId = $(this).data('id');
            var quantityInput = $('#quantity' + itemId);
            var displayQuantity = $('#displayQuantity' + itemId);
            var itemPrice = $('#itemPrice' + itemId);
            var currentQuantity = parseInt(quantityInput.val());
            if (currentQuantity > 1) {
                quantityInput.val(currentQuantity - 1);
                displayQuantity.text(currentQuantity - 1); // Update display quantity

                // Update price by multiplying the price per item by the new quantity
                var originalPrice = parseFloat(itemPrice.attr('data-original-price')); // Retrieve the original price
                var newPrice = originalPrice * (currentQuantity - 1); // Calculate the new price
                itemPrice.text('Rp.' + newPrice.toFixed(2)); // Update displayed price
                updateTotalPrice(); // Update total price
            }
        });
        $('#checkout-btn').click(function(event) {
            event.preventDefault(); // prevent form submit
            var cartData = []; // Array untuk menyimpan data cart
            // Loop melalui item cart dan tambahkan ke array cartData
            var total_prices = parseInt($('#totalPrice').text().replace('Rp.', ''));
            var metodePembayaran = $('input[name="metode_pembayaran"]:checked').val();
            $('.itemCheckbox:checked').each(function() {
                var itemId = $(this).data('id');
                var quantity = parseInt($('#quantity' + itemId).val());
                var itemPrice = parseFloat($('#itemPrice' + itemId).text().replace('Rp.', ''));
                var perangkatId = $(this).data('perangkat');

                cartData.push({
                    id: itemId,
                    perangkat_id: perangkatId,
                    quantity: quantity,
                    item_price: itemPrice,
                });
            });
            var formData = {
                cart_data: cartData,
                total_price: total_prices,
                metode_pembayaran: metodePembayaran
            };
            $.ajax({
                url: '<?= base_url('/client/checkout/process') ?>',
                method: 'POST',
                data: formData, // Serialize form data
                success: function(response) {
                    var data = response;
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    }).then(() => {
                        setTimeout(function() {
                            // Redirect to a new page after successful form submission
                            window.location.href = '<?= base_url('/client/pesananku') ?>';
                        }, 2000); // 2000 milliseconds = 2 seconds
                    })
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>