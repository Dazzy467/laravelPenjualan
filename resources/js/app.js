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
                    '<div class="d-flex justify-content-center"><div><a id="transactionDeleteRowBtn" href="#" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a></div></div>'
                ];

                // Menambahkan baris baru ke tabel
                tabelTransaksi.row.add(baris_baru).draw();
            }


        }
    });
}

function HapusBarangTransaksi()
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/kasir/TambahBarangKeTransaksi",
        data: {
            token : '<?php echo csrf_token() ?>'
        },
        dataType: 'json',
        success: function (data) {

        }
    });
}

$(document).ready(
    function()
    {
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


        $('#btnBuatTransaksi').click(
            function () { 
                
                BuatTransaksi();
            }
        );

        $('#btnSubmitTambahBarangTransaksiKasir').click(function () {
            TambahBarangKeTransaksi();
        });

        $('#transactionDeleteRowBtn').click(function ()
        {
            tabelTransaksi.row($(this).parents('tr')).remove().draw();
        }
        );

        // $('#tambahBarangTransaksiForm').on('submit', function(e) {
        //     e.preventDefault();
        //     TambahBarangKeTransaksi();
        // });

        $('#tambahBarangModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
        
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