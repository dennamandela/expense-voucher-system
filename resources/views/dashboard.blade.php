@extends('layouts.index')

@section('content')
<div class="app-content">
  <div class="container-fluid">

    <!-- ================= TITLE ================= -->
    <div class="mb-4">
      <h3 class="fw-bold mb-0">Dashboard Keuangan</h3>
      <small class="text-muted">
        Sistem Administrasi Keuangan – DPD PDI Perjuangan Jawa Barat
      </small>
    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Saldo Awal</small>
          <h5 class="fw-bold">
            Rp {{ number_format($saldoAwal, 0, ',', '.') }}
          </h5>
        </div>
      </div>

      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Total Penerimaan</small>
          <h5 class="fw-bold text-success">
            Rp {{ number_format($totalIncome, 0, ',', '.') }}
          </h5>
        </div>
      </div>

      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Total Pengeluaran</small>
          <h5 class="fw-bold text-danger">
            Rp {{ number_format($totalExpense, 0, ',', '.') }}
          </h5>
        </div>
      </div>

      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Saldo Akhir</small>
          <h5 class="fw-bold">
            Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
          </h5>
        </div>
      </div>
    </div>

    <!-- ================= AKSI CEPAT ================= -->
    <div class="mb-4 d-flex gap-2">
      <a href="{{ route('expense-voucher.create') }}" class="btn btn-pdip">
        <i class="bi bi-dash-circle"></i> Bon Pengeluaran
      </a>

      <a href="{{ route('income-voucher.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Bon Penerimaan
      </a>

      <a href="{{ route('reports.cash-book') }}" class="btn btn-outline-secondary">
        <i class="bi bi-file-earmark-text"></i> Laporan
      </a>
    </div>

    <!-- ================= TRANSAKSI TERAKHIR ================= -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Transaksi Terakhir</h3>
      </div>

      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Jenis</th>
              <th>Nomor</th>
              <th>Keterangan</th>
              <th class="text-end">Total</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($latestTransactions as $row)
              <tr>
                <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
                <td>
                  @if ($row->type === 'INCOME')
                    <span class="badge bg-success">Penerimaan</span>
                  @else
                    <span class="badge bg-danger">Pengeluaran</span>
                  @endif
                </td>
                <td>{{ $row->number }}</td>
                <td>{{ $row->subject }}</td>
                <td class="text-end">
                  Rp {{ number_format($row->total, 0, ',', '.') }}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted">
                  Belum ada transaksi
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection