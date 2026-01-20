@extends('layouts.income-voucher')

@section('content')
<div class="app-content">
  <div class="container-fluid">
    <div class="row g-4">

      <form action="{{ url('income-voucher/store') }}" method="POST">
        @csrf

        {{-- ================= HEADER ================= --}}
        <div class="col-md-12">
          <div class="card card-primary card-outline mb-4">
            <div class="card-header">
              <h3 class="card-title">Tambah Bon Penerimaan</h3>
            </div>

            <div class="card-body">

              {{-- Nomor Bon --}}
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

              {{-- Tanggal --}}
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

              {{-- Diterima Dari --}}
              <div class="mb-3">
                <label class="form-label">Diterima Dari</label>
                <input type="text"
                       name="received_from"
                       value="{{ old('received_from') }}"
                       class="form-control @error('received_from') is-invalid @enderror">

                @error('received_from')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Metode Pembayaran --}}
              <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method"
                        class="form-control @error('payment_method') is-invalid @enderror">
                  <option value="">-- Pilih --</option>
                  <option value="KAS" {{ old('payment_method') == 'KAS' ? 'selected' : '' }}>Kas</option>
                  <option value="BANK" {{ old('payment_method') == 'BANK' ? 'selected' : '' }}>Bank</option>
                </select>

                @error('payment_method')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Catatan --}}
              <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="notes"
                          rows="3"
                          class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>

                @error('notes')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

            </div>
          </div>
        </div>

        {{-- ================= DETAIL ================= --}}
        <div class="col-12">
          <div class="card card-success card-outline mb-4">
            <div class="card-header">
              <h3 class="card-title">Detail Penerimaan</h3>
            </div>

            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <th width="200">Jumlah (Rp)</th>
                    <th width="80">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  @php
                    $details = old('details', [ ['description' => '', 'amount' => ''] ]);
                  @endphp

                  @foreach ($details as $i => $detail)
                  <tr>
                    <td>
                      <input type="text"
                             name="details[{{ $i }}][description]"
                             value="{{ old("details.$i.description") }}"
                             class="form-control @error("details.$i.description") is-invalid @enderror">

                      @error("details.$i.description")
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </td>

                    <td>
                      <input type="number"
                             name="details[{{ $i }}][amount]"
                             value="{{ old("details.$i.amount") }}"
                             class="form-control @error("details.$i.amount") is-invalid @enderror">

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

              <button type="button"
                      class="btn btn-outline-primary btn-sm"
                      id="addRow">
                + Tambah Baris
              </button>
            </div>
          </div>
        </div>

        {{-- ================= SUBMIT ================= --}}
        <div class="col-12 text-end">
          <button type="submit"
                  class="btn btn-primary"
                  onclick="this.disabled=true;this.form.submit();">
            Simpan Bon
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection