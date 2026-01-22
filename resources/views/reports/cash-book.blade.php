@extends('layouts.report')

@section('content')
<div class="container-fluid">

  {{-- FILTER --}}
  <form method="GET" class="row g-2 mb-3">
    <div class="col-md-2">
      <input type="number" name="year" class="form-control"
             value="{{ $year }}">
    </div>

    <div class="col-md-2">
      <select name="month" class="form-select">
        @foreach(range(1,12) as $m)
          <option value="{{ $m }}" @selected($m == $month)>
            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-md-2">
      <select name="type" class="form-select">
        <option value="monthly" @selected($type === 'monthly')>
          Bulanan
        </option>
        <option value="daily" @selected($type === 'daily')>
          Harian
        </option>
      </select>
    </div>

    <div class="col-md-2">
      <button class="btn btn-primary">Terapkan</button>
    </div>
  </form>

  {{-- TABLE --}}
  <div class="card">
    <div class="card-body">

      @if ($type === 'daily')
      {{-- ================== HARIAN ================== --}}
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Uraian</th>
            <th class="text-end">Penerimaan</th>
            <th class="text-end">Pengeluaran</th>
            <th class="text-end">Saldo</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($rows as $i => $row)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $row['tanggal'] }}</td>
              <td>{{ $row['keterangan'] }}</td>
              <td class="text-end">{{ number_format($row['penerimaan']) }}</td>
              <td class="text-end">{{ number_format($row['pengeluaran']) }}</td>
              <td class="text-end fw-bold">
                {{ number_format($row['saldo_akhir']) }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">
                Tidak ada data
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>

      @else
      {{-- ================== BULANAN ================== --}}
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Bulan</th>
            <th class="text-end">Saldo Awal</th>
            <th class="text-end">Penerimaan</th>
            <th class="text-end">Pengeluaran</th>
            <th class="text-end">Saldo Akhir</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($rows as $i => $row)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>
                {{ \Carbon\Carbon::create()->month($row['bulan'])->translatedFormat('F') }}
              </td>
              <td class="text-end">{{ number_format($row['saldo_awal']) }}</td>
              <td class="text-end">{{ number_format($row['penerimaan']) }}</td>
              <td class="text-end">{{ number_format($row['pengeluaran']) }}</td>
              <td class="text-end fw-bold">
                {{ number_format($row['saldo_akhir']) }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">
                Tidak ada data
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      @endif

    </div>
  </div>
</div>
@endsection