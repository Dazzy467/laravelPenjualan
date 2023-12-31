import './bootstrap';
import '../css/app.css';

const sidebar = $('#sidebar');
const toggleButton = $('#toggleSidebar');
const sidebarCollapse = $('#sidebarCollapse');
const labels = $('.nav-label');
const content = $('#content');
const sidebarToggleDiv = $("#sidebarToggleDiv");

var isLessWidth = false;
var isMinimized = false;


let tabelUser = new DataTable('#userTable',{
    lengthMenu: [[5,10,-1],[5,10,'Semua']],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    }
});

let tabelBarang = new DataTable('#barangTable',{
    lengthMenu: [[5,10,-1],[5,10,'Semua']],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    }
});

let tabelTransaksi = new DataTable('#transactionTable',{
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
    dom: 'ftp'
});

let tabelTambahBarang = new DataTable('#tambahBarangTable',{
    lengthMenu: [[5,10,-1],[5,10,'Semua']],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
    dom: 'ftp'
});

let tabelRiwayatTransaksi = new DataTable('#riwayatTransaksiTable',
{
    dom: 'lfrtpB',
    lengthMenu: [[5,10,-1],[5,10,'Semua']],
    buttons: [
        'copy',
        {
            extend: 'excel',
            exportOptions:{
                columns: ':not(:last-child)'
            },
            title: 'Penjualan Natural Gypsum'
        },
        {
            extend: 'pdf',
            exportOptions:{
                columns: ':not(:last-child)'
            },
            title: 'Penjualan Natural Gypsum'
        }
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
});

let tabelSupplier = new DataTable('#supplierTable',{
    lengthMenu: [[5,10,-1],[5,10,'Semua']],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    },
});

let tabelCatatanSupplier = new DataTable('#itemSuplaiTable',{
    lengthMenu: [[5,10,-1],[5,10,'Semua']],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
    }
});

function BuatTransaksi()
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/kasir/BuatTransaksi",
        data: {
            token : "<?php echo csrf_token() ?>"
        },
        dataType: 'json',
        success: function (data) {
            $('#notaID').html("IdNota: " + data.idNota)
            $('#btnBuatTransaksi').toggleClass('disabled');
            $('#btnKonfirmasiTransaksi').toggleClass('disabled');
            $('#btnTambahBarangTransaksi').toggleClass('disabled');
        }
    });
}

function TambahBarangKeTransaksi()
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/kasir/TambahBarangKeTransaksi",
        data: {
            idBarang : $('#baranglist').val(),
            JumlahBarang : $('#inputjumlahBarang').val(),
            token : '<?php echo csrf_token() ?>'
        },
        dataType: 'json',
        success: function (data)
        {

            // Mendapatkan data dari tabel
            var dataTabel = tabelTransaksi.rows().data();

            // Mengecek duplikasi
            var isDuplikat = false;
            for (var i = 0; i < dataTabel.length; i++) {
                if (dataTabel[i][0] == data.Barang.namaBarang) {
                    isDuplikat = true;
                    // Menambah jumlah barang
                    var jumlahBarang = data.JumlahBarang;
                    // Menghitung ulang subtotal
                    console.log('Jumlah Barang:', data.JumlahBarang);
                    console.log('Harga Satuan:', data.HargaSatuan);
                    var subtotal = jumlahBarang * data.HargaSatuan;
                    console.log('Subtotal:', subtotal);
                    // Mengupdate baris di tabel
                    tabelTransaksi.cell(i, 1).data(jumlahBarang).draw();
                    tabelTransaksi.cell(i, 3).data(subtotal).draw();
                    break;
                }
            }
            if (!isDuplikat)
            {
                // Membuat baris baru
                var baris_baru = [
                    data.Barang.namaBarang,
                    data.JumlahBarang,
                    data.HargaSatuan,
                    data.SubTotal,
                    '<td><div class="d-flex justify-content-center"><div><a type="button" id="transactionDeleteRowBtn" href="#" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a></div></div></td>',
                ];

                // Menambahkan baris baru ke tabel
                tabelTransaksi.row.add(baris_baru).draw();
            }


        },
        error: function()
        {
            alert('Error, Inputan melebihi stok barang!');
            
        }
    });
}

function CatatItemSuplai()
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/gudang/catatSuplai",
        data: {
            idSupplier: $('#idSupplier').val(),
            idBarang : $('#baranglist').val(),
            JumlahBarang : $('#inputjumlahBarang').val(),
            totalKulakan : $('#inputTotalKulakan').val(),
            token : '<?php echo csrf_token() ?>'
        },
        dataType: 'json',
        success: function (data)
        {
            // Mendapatkan data dari tabel
            var dataTabel = tabelCatatanSupplier.rows().data();

            // Membuat baris baru
            var baris_baru = [
                '<td scope="row"><div class="text-center">' + data.no + '</div></td>',
                data.namaSupplier,
                data.namaBarang,
                data.jumlahBarang,
                data.tanggalMasuk,
                data.totalKulakan
            ];

            // // Menambahkan baris baru ke tabel
            tabelCatatanSupplier.row.add(baris_baru).draw();
        


        },
        error: function()
        {
            alert('Error, Inputan melebihi stok barang!');
            
        }
    });
}

function HapusBarangTransaksi(namaBarang)
{
    console.log("ini: " + namaBarang);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/kasir/HapusBarangTransaksi",
        data: {
            namaBarang: namaBarang,
            token : '<?php echo csrf_token() ?>'
        },
        dataType: 'json',
        success: function (data) {
            console.log(data.instance);
        }
    });
}

$(document).ready(
    function()
    {
        // Tombol hide/show navbar
        toggleButton.click(function ()
        {
            content.toggleClass('content-minimized');
            labels.each(function(){
                $(this).toggleClass('nav-label-minimized');
            });
            sidebar.toggleClass('sidebar-collapsed');
            sidebarToggleDiv.toggleClass('justify-content-center justify-content-end');
            isMinimized = !isMinimized;
        })

        // klik tombol buat transaksi
        $('#btnBuatTransaksi').click(
            function () { 
                
                BuatTransaksi();
            }
        );
        
        // Klik tombol submit tambah barang
        $('#btnSubmitTambahBarangTransaksiKasir').click(function () {
            TambahBarangKeTransaksi();
        });


        // Klik tombol delete pada tabel transaksi
        $('#transactionTable tbody').on('click', '#transactionDeleteRowBtn', function(){
            
            // var row = $(this).closest('tr');
            var row = tabelTransaksi.row($(this).parents('tr'));
            var data = row.data();
            console.log(data[0]); // ini akan mencetak data dari baris tersebut ke konsol
            HapusBarangTransaksi(data[0]);
            row.remove().draw();
        });

        // buat fokusin ke modal tambah barang (Kurang paham)
        $('#tambahBarangModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });


        //Update total harga di page transaksi
        tabelTransaksi.on('draw',function () {
            var Total = 0;
            tabelTransaksi.rows().every(function(rowIdx,tableLoop,rowLoop){
                var data = this.data();
                Total += parseInt(data[3]);
            });
            $('#labelTotalHarga').html('Total Harga: ' + Total);
        });

        // Tombol catat barang masuk
        $('#btnSubmitCatatSuplai').on('click',function () {
            CatatItemSuplai();
        })
        
        // $('#riwayatTransaksiTable').on('click', 'tr', function () {
        //     var table = $('#riwayatTransaksiTable').DataTable();
        //     var data = table.row( this ).data();
        //     alert( 'ID Nota: '+ data[1] );
        // });
        
        $(window).resize(function()
        {
            if ($(window).width() < 768 && !isLessWidth)
            {
                if (isMinimized)
                    sidebarToggleDiv.removeClass('d-flex justify-content-center pt-2');
                else sidebarToggleDiv.removeClass('d-flex justify-content-end pt-2');
                sidebarToggleDiv.css('display','none');
                $('#navlink').removeClass('mt-5');
                console.log('Hello');
                isLessWidth = true;
            }
            else if ($(window).width() > 768 && isLessWidth){
                if (isMinimized)
                    sidebarToggleDiv.addClass('d-flex justify-content-center pt-2');
                else 
                    sidebarToggleDiv.addClass('d-flex justify-content-end pt-2');
                $('#navlink').addClass('mt-5');
                isLessWidth = false;
            }
        });
    }
);