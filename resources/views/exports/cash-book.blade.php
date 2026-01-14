<table>
  <tr>
    <td colspan="6" align="center"><strong>REKAPITULASI BUKU KAS UMUM</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>DPD PDI PERJUANGAN</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>PROVINSI JAWA BARAT</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>TAHUN {{ $year }}</strong></td>
  </tr>

  <tr><td colspan="6"></td></tr>

  <tr>
    <th>No</th>
    <th>Bulan</th>
    <th>Penerimaan (Rp)</th>
    <th>Pengeluaran (Rp)</th>
    <th>Saldo (Rp)</th>
    <th>Keterangan</th>
  </tr>

  {{-- Saldo Awal Tahun --}}
  <tr>
    <td></td>
    <td><strong>Saldo Awal Tahun</strong></td>
    <td></td>
    <td></td>
    <td>{{ $saldoAwalTahun }}</td>
    <td></td>
  </tr>

  @php
    $no = 1;
    $totalPenerimaan = 0;
    $totalPengeluaran = 0;
  @endphp

  @foreach ($rows as $row)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $row['bulan'] }}</td>
      <td>{{ $row['penerimaan'] ?? 0 }}</td>
      <td>{{ $row['pengeluaran'] ?? 0 }}</td>
      <td>{{ $row['saldo'] ?? 0 }}</td>
      <td></td>
    </tr>

    @php
      $totalPenerimaan += $row['penerimaan'] ?? 0;
      $totalPengeluaran += $row['pengeluaran'] ?? 0;
    @endphp
  @endforeach

  {{-- Total --}}
  <tr>
    <td colspan="2"><strong>Total</strong></td>
    <td>{{ $totalPenerimaan }}</td>
    <td>{{ $totalPengeluaran }}</td>
    <td>{{ $saldoAwalTahun + $totalPenerimaan - $totalPengeluaran }}</td>
    <td></td>
  </tr>

  <tr><td colspan="6"></td></tr>

  <tr>
    <td colspan="6" align="center">
      Bandung, 31 Desember {{ $year }}
    </td>
  </tr>
  <tr>
    <td colspan="6" align="center">
      Bendahara DPD PDI Perjuangan<br>
      Provinsi Jawa Barat
    </td>
  </tr>
  <tr><td colspan="6"></td></tr>
  <tr>
    <td colspan="6" align="center"><strong>Budi Sembiring</strong></td>
  </tr>
</table>
