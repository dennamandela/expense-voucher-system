<table>
  <tr>
    <td colspan="7" align="center"><strong>BUKU KAS UMUM HARIAN</strong></td>
  </tr>
  <tr>
    <td colspan="7" align="center"><strong>DPD PDI PERJUANGAN</strong></td>
  </tr>
  <tr>
    <td colspan="7" align="center"><strong>PROVINSI JAWA BARAT</strong></td>
  </tr>
  <tr>
    <td colspan="7" align="center">
      <strong>
        PERIODE {{ \Carbon\Carbon::create($year, $month)->translatedFormat('F Y') }}
      </strong>
    </td>
  </tr>

  <tr><td colspan="7"></td></tr>

  <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th>Penerimaan (Rp)</th>
    <th>Pengeluaran (Rp)</th>
    <th>Saldo (Rp)</th>
    <th>Paraf</th>
  </tr>

  @php
    $no = 1;
    $totalPenerimaan = 0;
    $totalPengeluaran = 0;
  @endphp

  @foreach ($rows as $row)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $row['tanggal'] }}</td>
      <td>{{ $row['keterangan'] }}</td>
      <td>{{ $row['penerimaan'] ?? 0 }}</td>
      <td>{{ $row['pengeluaran'] ?? 0 }}</td>
      <td>{{ $row['saldo_akhir'] ?? 0 }}</td>
      <td></td>
    </tr>

    @php
      $totalPenerimaan += $row['penerimaan'] ?? 0;
      $totalPengeluaran += $row['pengeluaran'] ?? 0;
    @endphp
  @endforeach

  {{-- TOTAL --}}
  <tr>
    <td colspan="3"><strong>Total</strong></td>
    <td><strong>{{ $totalPenerimaan }}</strong></td>
    <td><strong>{{ $totalPengeluaran }}</strong></td>
    <td><strong>{{ $rows[count($rows)-1]['saldo_akhir'] ?? 0 }}</strong></td>
    <td></td>
  </tr>

  <tr><td colspan="7"></td></tr>

  <tr>
    <td colspan="7" align="center">
      Bandung, {{ \Carbon\Carbon::create($year, $month)->endOfMonth()->translatedFormat('d F Y') }}
    </td>
  </tr>
  <tr>
    <td colspan="7" align="center">
      Bendahara DPD PDI Perjuangan<br>
      Provinsi Jawa Barat
    </td>
  </tr>
  <tr><td colspan="7"></td></tr>
  <tr>
    <td colspan="7" align="center"><strong>Budi Sembiring</strong></td>
  </tr>
</table>