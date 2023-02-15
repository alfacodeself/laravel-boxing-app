<div class="row">
    <div class="col-xl-{{ $transaction->status == 'UNPAID' ? '7' : '12' }}">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">#{{ $transaction->reference }}</h5>
                <table>
                    <tr>
                        <th width="40%">Produk</th>
                        <td width="40%">{{ $transaction->order_items[0]->name }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Qty</th>
                        <td width="40%">{{ $transaction->order_items[0]->quantity }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Sub Total</th>
                        <td width="40%">{{ 'Rp.' . number_format($transaction->order_items[0]->subtotal) }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Metode Pembayaran</th>
                        <td width="40%">{{ $transaction->payment_name }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Nama</th>
                        <td width="40%">{{ $transaction->customer_name }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Email</th>
                        <td width="40%">{{ $transaction->customer_email }}</td>
                    </tr>
                </table>
                <hr>

                <strong
                    class="text-uppercase border text-dark px-3 py-2 font-18 badge shadow-lg bg-light">{{ $transaction->status }}</strong>
            </div>
        </div>
    </div>
    {{-- @dd($transaction->status == 'REFUND') --}}
    @if ($transaction->status == 'UNPAID')
        <div class="col-xl-5">
            <div class="card shadow-lg">
                <div class="card-header">
                    Instruksi Pembayaran
                </div>
                <div class="card-body">
                    @foreach ($transaction->instructions as $instruction)
                        <button type="button" style="width: 100%" class="btn mb-2 btn-dark dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $instruction->title }} <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu p-3 text-muted" style="max-width: 500px;">
                            <ol type="1">
                                @foreach ($instruction->steps as $step)
                                    <li>
                                        {!! $step !!}
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
