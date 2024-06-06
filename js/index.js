import {foo} from './util.js';


const select = document.getElementById("jenis-produk");

const table = new gridjs.Grid({
    columns: ["Nama Produk",
            "Harga",
            {
                name: "Aksi",
                formatter: (_, row) => {
                    return [gridjs.h('button', {
                      className: 'color: red',
                      onClick: () => alert(`Editing "${row.cells[0].data}" "${row.cells[1].data}"`)
                    }, 'Edit'),
                    gridjs.h('button', {
                        className: 'color: red',
                        onClick: () => alert(`Editing "${row.cells[0].data}" "${row.cells[1].data}"`)
                      }, 'Hapus')];
                  }
            }],
    data: []
    }
).render(document.getElementById("wrapper"));;

const onSelectChange = () => {
    const select = document.getElementById("jenis-produk");
    const selected = select.options[select.selectedIndex].value;
    if (selected == "makanan") {
        table.updateConfig({data: a}).forceRender();
    } else {
        table.updateConfig({data: b}).forceRender();
    }
}

const onButtonClick = () => {
    const select = document.getElementById("jenis-produk");
    const selected = select.options[select.selectedIndex].value;
}

const a = [
      ["John", "john@example.com", "(353) 01 222 3333"],
      ["Mark", "mark@gmail.com", "(01) 22 888 4444"],
    ];

  const b = [
      ["Bro", "john@example.com", "(353) 01 222 3333"],
      ["Mark", "mark@gmail.com", "(01) 22 888 4444"],
    ];

select.addEventListener('change', onSelectChange)
  