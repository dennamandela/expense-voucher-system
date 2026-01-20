@extends('layouts.income-voucher')
@section('content')
<div class="app-content">
    <div class="container-fluid">

        <!-- ===== TITLE ===== -->
        <div class="mb-4">
            <h3 class="fw-bold mb-1">Detail Bon Penerimaan</h3>
            <div class="text-muted">Informasi lengkap bon penerimaan</div>
        </div>

        <!-- ===== HEADER INFO ===== -->
        <div class="border rounded p-3 mb-4 bg-light">
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="text-muted small">Nomor Bon</div>
                    <div class="fw-semibold">{{ $incomeVoucher->number }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Tanggal</div>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($incomeVoucher->date)->format('d-m-Y') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Metode Pembayaran</div>
                    <span class="badge bg-secondary px-3">
                        {{ $incomeVoucher->payment_method }}
                    </span>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="text-muted small">Diterima dari</div>
                    <div class="fw-semibold">{{ $incomeVoucher->received_from }}</div>
                </div>
            </div>

            @if ($incomeVoucher->notes)
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="text-muted small">Catatan</div>
                    <div>{{ $incomeVoucher->notes }}</div>
                </div>
            </div>
            @endif
        </div>

        <!-- ===== DETAIL TABLE ===== -->
        <div class="mb-4">
            <h5 class="fw-semibold mb-2">Detail Pengeluaran</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Keterangan</th>
                            <th width="220" class="text-end">Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomeVoucher->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->description }}</td>
                            <td class="text-end">
                                {{ number_format($detail->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr class="fw-bold">
                            <td colspan="2" class="text-end">Total</td>
                            <td class="text-end">
                                Rp {{ number_format($incomeVoucher->total, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- ===== TERBILANG ===== -->
        <div class="border rounded p-3 mb-4">
            <div class="text-muted small mb-1">Terbilang</div>
            <em class="fw-semibold">
                {{ ucwords(terbilang($incomeVoucher->total)) }} Rupiah
            </em>
        </div>

        <!-- ===== METADATA ===== -->
        <div class="text-muted small mb-4">
            Dibuat:
            {{ $incomeVoucher->created_at->format('d-m-Y H:i') }}
            &nbsp;|&nbsp;
            Terakhir diubah:
            {{ $incomeVoucher->updated_at->format('d-m-Y H:i') }}
        </div>

        <!-- ===== ACTION ===== -->
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('income-voucher') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <a href="{{ route('income-voucher.edit', $incomeVoucher->id) }}"
               class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Edit
            </a>

            <a href="{{ route('income-voucher.print', $incomeVoucher->id) }}"
               target="_blank"
               class="btn btn-primary">
                <i class="bi bi-printer"></i> Print
            </a>
        </div>

    </div>
</div>
@endsection