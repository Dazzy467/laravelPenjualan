function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

$(document).ready(function () {
    console.log( "ready!" );
    let now = new Date();
    let startOfMonth = new Date(now.getFullYear(),now.getMonth(), 1);
    let endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0);

    let StartDate = $('#StartDate');
    StartDate.val(formatDate(startOfMonth))
    let EndDate = $('#EndDate');
    EndDate.val(formatDate(endOfMonth));

    // Event input jika di clear
    StartDate.on('input', function() {
        if (this.value === '') {
            this.value = formatDate(startOfMonth);
        }
    });

    // Event input jika di clear
    EndDate.on('input', function() {
        if (this.value === '') {
            this.value = formatDate(endOfMonth);
        }
    });

    // Fungsi filtering buat ngefilter kolom tabel indeks ke 0 yaitu kolom tanggal
    DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = new Date(StartDate.val());
        let max = new Date(EndDate.val());
        let date = new Date(data[0]);
     
        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    // Datatable
    let tabelPendapatan = new DataTable('#PendapatanTable',{
        dom: 'lfrtpB',
        lengthMenu: [[5,10,-1],[5,10,'Semua']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        },
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
    });

    let tabelPengeluaran = new DataTable('#PengeluaranTable',{
        dom: 'lfrtpB',
        lengthMenu: [[5,10,-1],[5,10,'Semua']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        },
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
        initComplete: function() {
            $('#PengeluaranTable_wrapper').hide();
        }
    });

    tabelPendapatan.on('draw', function() {
        let data = tabelPendapatan.rows({ filter: 'applied' }).data();
        let totalPendapatan = 0;
        for (let i = 0; i < data.length; i++) {
            totalPendapatan += parseInt(data[i][1]); // Ganti 1 dengan indeks kolom pendapatan
        }
        if ($('#KategoriLaporan').val() === 'Laporan Keuntungan')
        {
            $('#totalLable').text('Total Pendapatan ' + totalPendapatan);
        }
    });

    tabelPengeluaran.on('draw', function() {
        let data = tabelPengeluaran.rows({ filter: 'applied' }).data();
        let totalPengeluaran = 0;
        for (let i = 0; i < data.length; i++) {
            totalPengeluaran += parseInt(data[i][1]); // Ganti 1 dengan indeks kolom pendapatan
        }
        if ($('#KategoriLaporan').val() === 'Laporan Pengeluaran')
        {
            $('#totalLable').text('Total Pengeluaran ' + totalPengeluaran);
        }
    });

    // Refilter table nya
    document.querySelectorAll('#StartDate, #EndDate').forEach((el) => {
        el.addEventListener('change', () => {
            tabelPendapatan.draw(),
            tabelPengeluaran.draw()
        });
    });

    $('#KategoriLaporan').change(function () {
        if ($('#KategoriLaporan').val() === 'Laporan Pengeluaran')
        {
            $('#PendapatanTable_wrapper').hide();
            $('#PengeluaranTable_wrapper').show();
            tabelPengeluaran.draw();
        }
        else{
            $('#PendapatanTable_wrapper').show();
            $('#PengeluaranTable_wrapper').hide();
            tabelPendapatan.draw();
        }
        
    })

});