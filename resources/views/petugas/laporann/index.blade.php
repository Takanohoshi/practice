@include('layouts.petugas')

<h1>
    Laporan Peminjaman
</h1>

<button onclick="printTable()" class="btn btn-primary">Print Table</button>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataPeminjaman as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->user->username }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_kembali }}</td>
                <td>{{ $peminjaman->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function printTable() {
        const printWindow = window.open('', '', 'width=600,height=600');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('table, th, td { border: 1px solid black; border-collapse: collapse; }'); 
        printWindow.document.write('th, td { padding: 10px; }'); 
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<table>');
        printWindow.document.write(document.querySelector(".table").outerHTML);
        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>