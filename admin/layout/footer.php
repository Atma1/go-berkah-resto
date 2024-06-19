<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../js/index.js" type="module"></script>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.left = "0";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.left = "-250px";
        document.getElementById("main").style.marginLeft = "0";
    }
    function setModalUsed(modal) {
        document.getElementById('modal_used').value = modal;
    }

    const converter = (base64Image) => {
        const base64Data = base64Image.split(',')[1];
        const contentType = base64Image.split(',')[0].split(':')[1].split(';')[0];
        const byteCharacters = atob(base64Data);
        const byteNumbers = new Array(byteCharacters.length);
        for (let i = 0; i < byteCharacters.length; i++) {
            byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        const byteArray = new Uint8Array(byteNumbers);
        const blob = new Blob([byteArray], { type: contentType });
        return blob;
    }

    $(document).ready(function() {
        // AJAX untuk form add-minuman-form
        $('#add-minuman-form').submit(function(e) {
        e.preventDefault(); // Hindari pengiriman form secara default

        var formData = new FormData($(this)[0]); // Ambil data form
        $.ajax({
            url: './model/process_form.php', // URL ke process_form.php
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data minuman berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Refresh halaman jika perlu
                location.reload();
            });
            },
            error: function(xhr, status, error) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data minuman: ' + xhr.responseText
            });
            }
        });
        });

        // AJAX untuk form add-makanan-form
        $('#add-makanan-form').submit(function(e) {
        e.preventDefault(); // Hindari pengiriman form secara default

        var formData = new FormData($(this)[0]); // Ambil data form
        $.ajax({
            url: './model/process_form.php', // URL ke process_form.php
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data makanan berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Refresh halaman jika perlu
                location.reload();
            });
            },
            error: function(xhr, status, error) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data makanan: ' + xhr.responseText
            });
            }
        });
        });

        // AJAX untuk form add-sidedish-form
        $('#add-sidedish-form').submit(function(e) {
        e.preventDefault(); // Hindari pengiriman form secara default

        var formData = new FormData($(this)[0]); // Ambil data form
        $.ajax({
            url: './model/process_form.php', // URL ke process_form.php
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data sidedish berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Refresh halaman jika perlu
                location.reload();
            });
            },
            error: function(xhr, status, error) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data sidedish: ' + xhr.responseText
            });
            }
        });
        });
        // AJAX untuk form updateProductModal
        $('#update-product-form').submit(function(e) {
            e.preventDefault(); // Hindari pengiriman form secara default

            var formData = new FormData($(this)[0]); // Ambil data form
            const fileInput = $('#update-product-image-input')[0];
            const priviewSrc = document.getElementById('update-image-preview').src
            if (fileInput.files.length === 0) {
                const convertedImage = converter(priviewSrc)
                formData.delete("img")
                formData.append("img", convertedImage)
            }
            $.ajax({
                url: './model/process_form.php', // URL ke process_form.php
                type: 'POST',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                // Handle success
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Berhasil Diperbarui!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Refresh halaman jika perlu
                    location.reload();
                });
                },
                error: function(xhr, status, error) {
                // Handle error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memperbarui data.: ' + xhr.responseText
                });
                }
            });
        });
    });
</script>

</body>
</html>