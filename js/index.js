import {getAllProduct, deleteProduct, getProduct} from './util.js'

const select = document.getElementById("jenis-produk");
const addNewProductButton = document.getElementById("add-product-button");
let dataArray;

const table = new gridjs.Grid({
    sort: true,
    search: true,
    columns: [
            {
                name: "id",
                hidden: true
            },
            "Nama Produk",
            "Harga",
            {
                name: "keterangan",
                hidden: true
            },
            {
                name: "img",
                hidden: true
            },
            {
                name: "Aksi",
                formatter: (_, row) => {
                    return [gridjs.h('button', {
                      className: 'color: red, edit-button',
                      onClick: () => onEditProductClick(row.cells)
                    }, 'Edit'),
                    gridjs.h('button', {
                        className: 'color: red delete-button',
                        onClick: () => onDeleteProductClick(row.cells[0].data)
                      }, 'Hapus')];
                  }
            }, 
            {
                name: "test",
                hidden: true
            }
    ],
    data: []
}).render(document.getElementById("wrapper"));

const onSelectChange = async () => {
    const selected = select.options[select.selectedIndex].value;
    const {message, data} = await getAllProduct(selected);
    if (message === "No data found") return;
    dataArray = data.map((dataObject) => Object.values(dataObject));
    table.updateConfig({data: dataArray}).forceRender();
}

const onEditProductClick = async (row) => {
    // Fetch product data
    const selected = select.options[select.selectedIndex].value;
    const imgElement = document.getElementById('update-image-preview');
    document.getElementById('update-product-id').value = row[0].data;
    document.getElementById('update-modal-used').value = selected;
    document.getElementById('update-product-name').value = row[1].data;
    document.getElementById('update-product-price').value = row[2].data
    document.getElementById('update-image-preview').src = `data:image/png;base64,${row[3].data}`;
    document.getElementById('update-product-description').value = row[4].data;
    document.getElementById('update-product-category').value = row[5].data;

    const imgInput = document.getElementById('update-product-image-input');
    const imageData = imgElement.src.replace(/^data:image\/(png|jpg|jpeg);base64,/, '');

    // Create a new Blob object from the image data

    const blob = new Blob([imageData], { type: 'image/png' }); // or 'image/jpeg' depending on the image type

    // Create a new File object from the Blob

    const file = new File([blob], 'image.png', { type: 'image/png'}); // or 'image/jpeg' depending on the image type
    const dataTransfer = new DataTransfer();

    dataTransfer.items.add(file);

    imgInput.files = dataTransfer.files;
    // Show modal

    const updateModal = new bootstrap.Modal(document.getElementById('updateProductModal'));
    updateModal.show();

    if (selected != "makanan") {
        document.getElementById('update-makanan-category').style.visibility = 'hidden';
    }
}

const onDeleteProductClick = async (productId) => {
    const selected = select.options[select.selectedIndex].value;
    const alertDialog = await Swal.fire({
        title: "Yakin akan menghapus produk ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#CB997E",
        cancelButtonColor: "#A5A58D",
        confirmButtonText: "Hapus",
        background: "#FFE8D6"
    })
    if (alertDialog.isConfirmed) {
        const result = await deleteProduct(selected, productId);
        if (result) {
            const updatedData = dataArray.filter((data) => data[0] != productId);
            dataArray = updatedData;
            table.updateConfig({data: dataArray}).forceRender();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Produk berhasil dihapus!',
                showConfirmButton: false,
                timer: 1500
            })
        }   
    }
}

select.addEventListener('change', onSelectChange);

document.getElementById('update-product-image-input').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const imagePreview = document.getElementById('update-image-preview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }
});