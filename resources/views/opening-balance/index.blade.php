@extends('layouts.opening-balance')

@section('content')
<div class="app-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <div class="card-header">
            <div class="row w-100 align-items-center">
              <div class="col-md-6">
                <h3 class="card-title mb-0">Master Data Saldo Awal</h3>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                  <i class="bi bi-plus-circle"></i> Tambah Saldo Awal
                </button>
              </div>
            </div>
          </div>

          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tahun</th>
                  <th>Bulan</th>
                  <th>Saldo Awal (KAS)</th>
                  <th>Aksi</th>
                </tr>
                </thead>
              <tbody>
                @forelse ($openingBalances as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->year }}</td>
                    <td>{{ \Carbon\Carbon::create()->month($row->month)->translatedFormat('F') }}</td>
                    <td>Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                    <td class="text-nowrap">

                      <!-- EDIT -->
                      <button
                        class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal-{{ $row->id }}">
                        <i class="bi bi-pencil-square"></i>
                      </button>

                      <!-- DELETE -->
                      <form
                        action="{{ route('opening-balances.destroy', $row->id) }}"
                        method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                          onclick="return confirm('Yakin hapus saldo awal?')">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>

                  {{-- MODAL EDIT --}}
                  <div class="modal fade" id="editModal-{{ $row->id }}" tabindex="-1">
                    <div class="modal-dialog">
                      <form action="{{ route('opening-balances.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Saldo Awal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-2">
                              <label>Tahun</label>
                              <input type="number" name="year" class="form-control" value="{{ $row->year }}" required>
                            </div>
                            <div class="mb-2">
                              <label>Metode</label>
                              <select name="month" class="form-control">
                              @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $row->month == $m ? 'selected' : '' }}>
                                  {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                              @endfor
                            </select>
                            </div>
                            <div class="mb-2">
                              <label>Saldo Awal</label>
                              <input type="number" name="amount" class="form-control" value="{{ $row->amount }}" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted">
                      Belum ada data saldo awal
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('opening-balances.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Saldo Awal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label>Tahun</label>
            <input type="number" name="year" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Bulan</label>
            <select name="month" class="form-control" required>
              @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}">
                  {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
              @endfor
            </select>
          </div>
          <div class="mb-2">
            <label>Saldo Awal</label>
            <input type="number" name="amount" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection