@extends('layouts.form')

@section('content')
<div class="app-content">
  <div class="container-fluid">
    <div class="row g-4">

      <form action="{{ url('expense-voucher/store') }}" method="POST">
        @csrf

        <!-- ================= HEADER ================= -->
        <div class="col-md-12">
          <div class="card card-primary card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Tambah Bon Pengeluaran</div>
            </div>

            <div class="card-body">

              <div class="mb-3">
                <label class="form-label">Nomor Bon</label>
                <input type="text"
                       name="number"
                       value="{{ old('number') }}"
                       class="form-control @error('number') is-invalid @enderror">
                @error('number')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date"
                       name="date"
                       value="{{ old('date', date('Y-m-d')) }}"
                       class="form-control @error('date') is-invalid @enderror">
                @error('date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Dibayarkan Kepada</label>
                <input type="text"
                       name="paid_to"
                       value="{{ old('paid_to') }}"
                       class="form-control @error('paid_to') is-invalid @enderror">
                @error('paid_to')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method"
                        class="form-control @error('payment_method') is-invalid @enderror">
                  <option value="">-- Pilih --</option>
                  <option value="KAS" {{ old('payment_method') === 'KAS' ? 'selected' : '' }}>Kas</option>
                  <option value="BANK" {{ old('payment_method') === 'BANK' ? 'selected' : '' }}>Bank</option>
                </select>
                @error('payment_method')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="notes"
                          class="form-control @error('notes') is-invalid @enderror"
                          rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

            </div>
          </div>
        </div>

        <!-- ================= DETAIL ================= -->
        <div class="col-12">
          <div class="card card-success card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Detail Pengeluaran</div>
            </div>

            <div class="card-body">
              <table class="table table-bordered" id="expenseTable">
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <th width="200">Jumlah (Rp)</th>
                    <th width="80">Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  @php
                    $oldDetails = old('details', [['description' => '', 'amount' => '']]);
                  @endphp

                  @foreach ($oldDetails as $i => $d)
                    <tr>
                      <td>
                        <input type="text"
                               name="details[{{ $i }}][description]"
                               value="{{ old("details.$i.description", $d['description'] ?? '') }}"
                               class="form-control @error("details.$i.description") is-invalid @enderror">
                        @error("details.$i.description")
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </td>

                      <td>
                        <input type="number"
                               name="details[{{ $i }}][amount]"
                               value="{{ old("details.$i.amount", $d['amount'] ?? '') }}"
                               class="form-control amount @error("details.$i.amount") is-invalid @enderror">
                        @error("details.$i.amount")
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </td>

                      <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm removeRow">❌</button>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>

              {{-- total hidden boleh ada, tapi jangan dipercaya server --}}
              <input type="hidden" name="total" id="totalInput" value="{{ old('total') }}">

              <br>
              <button type="button" class="btn btn-outline-primary btn-sm" id="addRow">
                + Tambah Baris
              </button>
            </div>

            <div class="card-footer text-end">
              <h5>Total: Rp <span id="totalText">0</span></h5>
            </div>
          </div>
        </div>

        <!-- ================= SUBMIT ================= -->
        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
            Simpan Bon
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
