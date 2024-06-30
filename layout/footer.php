<!-- Instalasi Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function loadContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    function openModal(nama, img, keterangan, harga) {
        document.getElementById('modalNama').textContent = nama;
        document.getElementById('modalImg').src = img;
        document.getElementById('modalKeterangan').textContent = keterangan;
        document.getElementById('modalHarga').textContent = "Harga: " + harga;
        resetQuantityInput();
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
            keyboard: false
        });
        myModal.show();
    }

    function closeModal() {
        var modal = document.getElementById('exampleModal');
        var bootstrapModal = bootstrap.Modal.getInstance(modal);

        if (bootstrapModal) {
            bootstrapModal.hide();
        }
    }

    function resetQuantityInput() {
        var defaultQuantity = 1;
        document.querySelector('.quantity-input').value = defaultQuantity;
    }

    function pesan() {
        var nama = document.getElementById('modalNama').textContent;
        var harga = document.getElementById('modalHarga').textContent.replace("Harga: ", "");
        var jumlah = document.querySelector('.quantity-input').value;
        
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nama: nama, harga: harga, jumlah: jumlah })
        })
        .then(response => response.json())
        .then(data => {
            openNotificationModal();
            closeModal();
            resetQuantityInput();
        })
        .catch(error => console.error('Error:', error));
    }

    function openNotificationModal() {
        var nama = document.getElementById('modalNama').innerText;
        var jumlah = document.querySelector('.quantity-input').value;
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalIndex'));
        
        if (modal) {
            modal.hide();
        }

        Swal.fire({
            title: jumlah + " menu - " + nama + "<br>telah ditambahkan<br>ke keranjang.",
            icon: "success",
            confirmButtonColor: "#CB997E",
            background: "#FFE8D6"
        });
    }

        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

            function openCartModal() {
                fetch('load_cart_content.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('cartModalContent').innerHTML = data;

                        var myModal = new bootstrap.Modal(document.getElementById('cartModal'), {
                            keyboard: false
                        });

                        myModal.show(); // Menampilkan modal
                    })
                    .catch(error => console.error('Error:', error));
            }

            function closeCartModal() {
                var myModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));

                if (myModal) {
                    myModal.hide();
                }
            }

            function removeItem(index) {
                Swal.fire({
                    title: "Yakin akan menghapus pesanan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#CB997E",
                    cancelButtonColor: "#A5A58D",
                    confirmButtonText: "Hapus",
                    background: "#FFE8D6"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('remove_item.php?index=' + index)
                            .then(response => response.text())
                            .then(data => {
                                // Menutup modal sebelum memperbarui konten
                                var myModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));
                                if (myModal) {
                                    myModal.hide();
                                }

                                Swal.fire({
                                    title: "Terhapus",
                                    icon: "success",
                                    confirmButtonColor: "#CB997E",
                                    background: "#FFE8D6"
                                }).then(() => {
                                    openCartModal();
                                });
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            }

            function updateQuantity(index, quantity) {
                fetch('update_quantity.php?index=' + index + '&quantity=' + quantity)
                    .then(response => response.text())
                    .then(data => {
                        fetchCartContent();
                    })
                    .catch(error => console.error('Error:', error));
            }

            function fetchCartContent() {
                fetch('load_cart_content.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('cartModalContent').innerHTML = data;
                        updateTotalPrice();
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateTotalPrice() {
                var totalHargaElement = document.getElementById('totalHarga');
                var totalHarga = parseFloat(totalHargaElement.dataset.totalharga);
                var cartItems = document.querySelectorAll('.cart-item');
                cartItems.forEach(item => {
                    var hargaElement = item.querySelector('.harga');
                    var jumlahElement = item.querySelector('.quantity-input');
                    var harga = parseFloat(hargaElement.dataset.harga);
                    var jumlah = parseInt(jumlahElement.value);
                    totalHarga += harga * jumlah;
                });
                totalHargaElement.textContent = "Total Harga: Rp " + number_format(totalHarga, 0, ',', '.');
            }

            function decreaseQuantity(button) {
                var input = button.nextElementSibling;
                var value = parseInt(input.value, 10);
                value = isNaN(value) ? 1 : value;
                value = value > 1 ? value - 1 : 1;
                input.value = value;
                var index = input.getAttribute('data-index');
                updateQuantity(index, value);
            }

            function increaseQuantity(button) {
                var input = button.previousElementSibling;
                var value = parseInt(input.value, 10);
                value = isNaN(value) ? 1 : value;
                value++;
                input.value = value;
                var index = input.getAttribute('data-index');
                updateQuantity(index, value);
            }

        function redirectToCheckout() {
            window.location.href = 'checkout.php';
        }

        //Carousel
        document.addEventListener("DOMContentLoaded", function () {
            let carousel = document.querySelector(".carousel");
            let items = carousel.querySelectorAll(".item");

            function showItem(index) {
                items.forEach((item, idx) => {
                item.classList.remove("active");
                if (idx === index) {
                    item.classList.add("active");
                }
                });
            }

            document.querySelector(".prev").addEventListener("click", () => {
                let index = [...items].findIndex((item) =>
                item.classList.contains("active")
                );
                showItem((index - 1 + items.length) % items.length);
            });

            document.querySelector(".next").addEventListener("click", () => {
                let index = [...items].findIndex((item) =>
                item.classList.contains("active")
                );
                showItem((index + 1) % items.length);
            });
        });

    //Card index
    function goToPage(page) {
        switch (page) {
            case 'Paket Hemat':
                window.location.href = 'paket_hemat.php';
                break;
            case 'Rice Bowl':
                window.location.href = 'rice_bowl.php';
                break;
            case 'Makanan':
                window.location.href = 'makanan.php';
                break;
            case 'Minuman':
                window.location.href = 'minuman.php';
                break;
            case 'Juice':
                window.location.href = 'juice.html';
                break;
            case 'Side Dish':
                window.location.href = 'side-dish.php';
                break;
            default:
                break;
        }
    }

    function openModalIndex(element) {
        const id = element.getAttribute('data-id');
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_menu_data.php?id=' + id, true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                const modalContent = document.getElementById('modalContent');
                if (modalContent) {
                    modalContent.innerHTML = xhr.responseText;
                    const modal = new bootstrap.Modal(document.getElementById('modalIndex'));
                    modal.show();
                } else {
                    console.error('Elemen modalContent tidak ditemukan');
                }
            } else {
                console.error('Gagal mengambil data');
            }
        };
        xhr.send();
    }

    //preloading screen
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        const mainContent = document.getElementById('mainContent');

        setTimeout(function() {
            document.getElementById('preloader').style.opacity = '0';
            setTimeout(function() {
                preloader.style.display = 'none';
                mainContent.style.display = 'block';
                window.location.href = 'home.php';
            }, 750);
        }, 3000);
    });

    //Checkout
    function cancelCheckout() {
        window.location.href = 'home.php';
    }

    document.getElementById('dineInForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const name = document.getElementById('dine_in_name').value;
        const table = document.getElementById('dine_in_table').value;

        if (name.trim() === '' || table.trim() === '') {
            Swal.fire({
                title: 'Peringatan',
                text: 'Silakan isi nama dan nomor tempat duduk Anda.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'Konfirmasi Pesanan',
                text: 'Apakah Anda yakin ingin mengkonfirmasi pesanan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        }
    });

    document.getElementById('takeAwayForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const name = document.getElementById('take_away_name').value;
        const phone = document.getElementById('take_away_phone').value;

        if (name.trim() === '' || phone.trim() === '') {
            Swal.fire({
                title: 'Peringatan',
                text: 'Silakan isi nama dan nomor HP Anda.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'Konfirmasi Pesanan',
                text: 'Apakah Anda yakin ingin mengkonfirmasi pesanan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        }
    });

    document.querySelector('.quantity-input').addEventListener('input', function(event) {
        var value = event.target.value;
        if (!(/^\d+$/.test(value))) {
            Swal.fire({
                title: "Hanya dapat<br>memasukkan Angka saja!",
                icon: "warning",
                confirmButtonColor: "#CB997E",
                background: "#FFE8D6"
            });
            event.target.value = value.slice(0, -1);
        }
    });
</script>

</body>
</html>