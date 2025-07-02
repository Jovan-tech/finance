@extends('layoutbootstrap')

<style>
    @media print {
        .no-print {
            display: none !important;
        }

        body {
            margin: 0;
        }
    }
</style>

@section('konten')
<!-- Main wrapper -->
<div class="body-wrapper" style="padding-top: 100px;">

    <!-- Container -->
    <div class="container mt-4">
        <div class="mb-3 no-print">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="fw-bold mb-1">Struk Pembayaran</h4>
                    <small>No Transaksi: {{ $transaksi->id }}</small><br>
                    <small>Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y H:i') }}</small>
                </div>

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->items as $item)
                        <tr>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <table class="table table-borderless">
                    <tr>
                        <td>Subtotal</td>
                        <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Pajak Restoran (10%)</td>
                        <td class="text-end">Rp {{ number_format($pajak, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <th class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </table>

                <div class="text-center mt-4 no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="ti ti-printer"></i> Cetak Struk
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
