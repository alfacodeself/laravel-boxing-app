<h4 class="mt-0 header-title">Data Transaksi</h4>

<table id="trxTable" class="table w-100 table-bordered dt-responsive table-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Anggota</th>
            <th>Harga Per Bulan</th>
            <th>Berlanggan Selama</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->reference }}</td>
                <td>{{ $transaction->memberHasProgramClass->member->nama }}</td>
                <td>{{ 'Rp. ' . number_format($transaction->memberHasProgramClass->harga_per_bulan) }}
                </td>
                <td>{{ $transaction->memberHasProgramClass->berlangganan_selama }} Bulan</td>
                <td>{{ 'Rp. ' . number_format($transaction->memberHasProgramClass->total_harga) }}
                </td>
                <td>
                    @if ($transaction->status == 'paid')
                        <span class="badge px-2 text-uppercase bg-success">{{ $transaction->status }}</span>
                    @elseif ($transaction->status == 'unpaid')
                        <span class="badge px-2 text-uppercase bg-warning text-dark">{{ $transaction->status }}</span>
                    @else
                        <span class="badge px-2 text-uppercase bg-danger">{{ $transaction->status }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
