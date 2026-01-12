@extends('layouts.report')

@section('content')
<div class="app-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">

          {{-- HEADER --}}
          <div class="card-header">
            <div class="row w-100 align-items-center">
              <div class="col-md-6">
                <h3 class="card-title mb-0">Laporan Buku Kas</h3>
              </div>

              {{-- FILTER --}}
              <div class="col-md-6 text-end">
                <form method="GET" class="d-inline-block">
                  <div class="input-group input-group-sm">

                    <select name="year" class="form-select">
                      @for ($y = now()->year; $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                          {{ $y }}
                        </option>
                      @endfor
                    </select>

                    <select name="payment_method" class="form-select">
                      <option value="">Semua</option>
                      <option value="KAS" {{ $paymentMethod == 'KAS' ? 'selected' : '' }}>KAS</option>
                      <option value="BANK" {{ $paymentMethod == 'BANK' ? 'selected' : '' }}>BANK</option>
                    </select>

                    <input type="number"
                           name="saldo_awal"
                           class="form-control"
                           placeholder="Saldo Awal"
                           value="{{ $saldoAwal }}">

                    <button class="btn btn-secondary">
                      <i class="bi bi-filter"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- BODY --}}
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 60px">No</th>
                  <th>Bulan</th>
                  <th class="text-end">Penerimaan</th>
                  <th class="text-end">Pengeluaran</th>
                  <th class="text-end">Saldo</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($rows as $i => $row)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row['bulan'] }}</td>
                    <td class="text-end">
                      Rp {{ number_format($row['penerimaan'], 0, ',', '.') }}
                    </td>
                    <td class="text-end">
                      Rp {{ number_format($row['pengeluaran'], 0, ',', '.') }}
                    </td>
                    <td class="text-end fw-bold">
                      Rp {{ number_format($row['saldo'], 0, ',', '.') }}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted">
                      Tidak ada data laporan
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- FOOTER --}}
          <div class="card-footer text-end">
            <a href="#', request()->query()) }}"
               class="btn btn-sm btn-success">
              <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
@endsection
