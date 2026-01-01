<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Bukti Pengeluaran</title>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        margin: 0;
        padding: 0;
    }

    @page {
        size: A4 portrait;
        margin: 10mm;
    }

    /* ===== CONTAINER SETENGAH A4 ===== */
    .container {
        width: 98.5%;
        min-height: 14.2cm;
        border: 1px solid #000;
        padding: 10px;
        box-sizing: border-box;
        page-break-inside: avoid;
    }

    .container:nth-child(2n) {
        page-break-after: always;
    }

    /* ===== HEADER ===== */
    .header {
        display: table;
        width: 100%;
        border-bottom: 2px solid #000;
        margin-bottom: 8px;
    }

    .header-left {
        display: table-cell;
        width: 70px;
        vertical-align: middle;
    }

    .logo {
        width: 80px;      /* sesuaikan */
        height: auto;
    }

    .header-right {
        display: table-cell;
        vertical-align: middle;
        font-size: 13px;
        line-height: 1.4;
    }

    /* ===== TITLE ===== */
    .bukti-wrapper {
        text-align: center;
        margin: 6px;
        margin-bottom: 10px;
    }

    .bukti-title {
        display: inline-block;
        border: 2px solid #000;
        padding: 5px 25px;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 6px;
    }

    .kas-bank {
    text-align: center;
    margin-top: 2px;
    margin-bottom: 8px;
    line-height: 1.3;

}

.cb {
    display: inline-table;
    vertical-align: middle;
    margin: 0 14px;
    font-size: 13px;
}

.cb input {
    margin: 0;
    padding: 0;
    vertical-align: middle;
    position: relative;
    top: -2px;   /* INI KUNCI DOMPDF */
}

.cb-text {
    display: inline-block;
    vertical-align: middle;
    margin-left: 4px;
    line-height: 1;
}


    /* ===== INFO ===== */
    .info {
        display: table;
        width: 100%;
        margin-bottom: 6px;
    }

    .info-col {
        display: table-cell;
        width: 50%;
        vertical-align: top;
    }

    .row {
    display: table;
    width: 100%;
    margin-bottom: 5px;
}

.label {
    display: table-cell;
    width: 150px;        /* KUNCI UTAMA */
    white-space: nowrap;
}

.separator {
    display: table-cell;
    width: 10px;
    text-align: center;
}

.value {
    display: table-cell;
}

    /* ===== TABLE ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        font-size: 12.5px;
    }

    th {
        text-align: center;
    }

    .jumlah {
        text-align: center;
        vertical-align: middle;
    }

    .keterangan {
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
    }

    /* ===== TERBILANG ===== */
    .terbilang {
        display: table;
        width: 100%;
        margin-top: 8px;
        font-size: 12.5px;
    }

    .terbilang-label {
        display: table-cell;
        width: 150px;
        white-space: nowrap;
    }

    .terbilang-sep {
        display: table-cell;
        width: 10px;
        text-align: center;
    }

    .terbilang-line {
        display: table-cell;
        border-bottom: 1px solid #000; /* GARISNYA */
        padding-bottom: 2px;
    }

    /* ===== FOOTER ===== */
    .footer {
        margin-top: 12px;
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .footer-row {
        display: table-row;
    }

    .sign, .keuangan {
        display: table-cell;
        border: 1px solid #000;
        font-size: 12px;
        padding: 5px;
        vertical-align: top;
    }

    .sign {
        width: 18%;
        height: 85px;
        text-align: center;
        vertical-align: top;
        padding-top: 5px;
    }

    .sign-space {
        height: 40px; /* ruang tanda tangan */
    }

    .sign-line {
        border-top: 1px solid #000;
        margin: 0 10px;
    }

    .sign-title {
    margin-bottom: 2px;
}

.sign-title-line {
    border-top: 1px solid #000;
    margin: 0 10px 6px 10px;
}



    .keuangan {
        width: 28%;
    }
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="header-left">
            <img src="file://{{ public_path('images/pdip.png') }}"
                class="logo"
                alt="Logo">
        </div>
        <div class="header-right">
            <strong>DPD PDI PERJUANGAN JAWA BARAT</strong><br>
            Sekretariat : Jl. Pelajar Pejuang 45 No. 1<br>
            Telp. 022-7300428 | Bandung
        </div>
    </div>

    <!-- TITLE -->
    <div class="bukti-wrapper">
        <div class="bukti-title">BUKTI PENGELUARAN</div>
        <div class="kas-bank">
    <span class="cb">
        <input type="checkbox" {{ $voucher->payment_method === 'KAS' ? 'checked' : '' }}>
        <span class="cb-text">KAS</span>
    </span>

    <span class="cb">
        <input type="checkbox" {{ $voucher->payment_method === 'BANK' ? 'checked' : '' }}>
        <span class="cb-text">BANK</span>
    </span>
</div>
    </div>

    <!-- INFO -->
    <div class="info">
        <div class="info-col">
            <div class="row">
                <span class="label">Dibayarkan Kepada</span>
                <span class="separator">:</span>
                <span class="value">{{ $voucher->paid_to }}</span>
            </div>
        </div>
        <div class="info-col">
            <div class="row">
                <span class="label">Nomor</span>:
                {{ $voucher->number }}
            </div>
            <div class="row">
                <span class="label">Tanggal</span>:
                {{ \Carbon\Carbon::parse($voucher->date)->format('d-m-Y') }}
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>KETERANGAN</th>
                <th>JUMLAH</th>
                <th>CATATAN</th>
            </tr>
        </thead>
        <tbody>
        @foreach($voucher->details as $detail)
        <tr style="height:36px">
            <td class="keterangan">{{ $detail->description }}</td>
            <td class="jumlah">
                Rp {{ number_format($detail->amount, 0, ',', '.') }}
            </td>
            <td>{{ $voucher->notes }}</td>
        </tr>
        @endforeach

        <tr>
            <td style="text-align:center;"><strong>Jumlah</strong></td>
            <td class="jumlah">
                <strong>Rp {{ number_format($voucher->total, 0, ',', '.') }}</strong>
            </td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <!-- TERBILANG (PINDAH KE SINI) -->
    <div class="terbilang">
        <span class="terbilang-label">Terbilang</span>
        <span class="terbilang-sep">:</span>
        <span class="terbilang-line">
            {{ terbilang($voucher->total) }} rupiah
        </span>
    </div>

    <!-- FOOTER -->
    <table style="margin-top:12px; width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th style="border:1px solid #000; text-align:center; width:14%;">Diminta</th>
            <th style="border:1px solid #000; text-align:center; width:14%;">Diperiksa</th>
            <th style="border:1px solid #000; text-align:center; width:14%;">Disetujui</th>
            <th style="border:1px solid #000; text-align:center; width:14%;">Diterima</th>
            <th style="border:1px solid #000; text-align:center; width:44%;">Data Keuangan</th>
        </tr>
    </thead>
    <tbody>
        <tr style="height:70px;">
            <td style="border:1px solid #000; vertical-align:middle;"></td>
            <td style="border:1px solid #000; vertical-align:middle;"></td>
            <td style="border:1px solid #000; vertical-align:middle;"></td>
            <td style="border:1px solid #000; vertical-align:middle;"></td>

            <td style="border:1px solid #000; padding:6px; vertical-align:top;">

                <div style="margin-bottom:6px; white-space:nowrap;">
                    <span style="display:inline-block; width:85px;">Bank</span> :
                    <span style="display:inline-block; width:200px; border-bottom:1px solid #000; box-sizing:border-box;"></span>
                </div>

                <div style="margin-bottom:6px; white-space:nowrap;">
                    <span style="display:inline-block; width:85px;">A/C No.</span> :
                    <span style="display:inline-block; width:200px; border-bottom:1px solid #000; box-sizing:border-box;"></span>
                </div>

                <div style="margin-bottom:6px; white-space:nowrap;">
                    <span style="display:inline-block; width:85px;">No. Chq / BG</span> :
                    <span style="display:inline-block; width:200px; border-bottom:1px solid #000; box-sizing:border-box;"></span>
                </div>

                <div style="margin-bottom:6px; white-space:nowrap;">
                    <span style="display:inline-block; width:85px;">Tgl J/T</span> :
                    <span style="display:inline-block; width:200px; border-bottom:1px solid #000; box-sizing:border-box;"></span>
                </div>

                <div style="white-space:nowrap;">
                    <span style="display:inline-block; width:85px;">Kasir</span> :
                    <span style="display:inline-block; width:200px; border-bottom:1px solid #000; box-sizing:border-box;"></span>
                </div>

            </td>   
        </tr>
    </tbody>
</table>






</div>

</body>
</html>
