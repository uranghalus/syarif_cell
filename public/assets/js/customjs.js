function checkScreenWidth() {
    var container = document.getElementById('container');
    var buttonContainer = document.getElementById('button-container');

    if (window.innerWidth < 500) {
        // Jika lebar layar kurang dari 500px, hilangkan style pada buttonContainer
        buttonContainer.style = '';
    } else {
        // Jika lebar layar 500px atau lebih, tambahkan atau kembalikan style pada buttonContainer
        buttonContainer.style = 'top: 50%; left: 50%; transform: translate(-50%, -50%);';
    }
}

// Panggil fungsi saat halaman dimuat dan saat ukuran layar berubah
window.onload = checkScreenWidth;
window.onresize = checkScreenWidth;