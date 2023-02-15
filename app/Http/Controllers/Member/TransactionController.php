<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TripayService;
use App\Http\Controllers\Controller;
use App\Models\MemberHasProgramClass;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    public function create(MemberHasProgramClass $memberHasProgramClass)
    {
        if ($memberHasProgramClass->transactions->where('status', 'pending')->count() >0) {
            return back()->with('error', 'Anda memiliki transaksi yang masih berjalan. Harap lunasi terlebih dahulu');
        }
        $channels = TripayService::getPaymentChannels();
        $id = $memberHasProgramClass->id;
        return view('app.member.transaction.create', compact('channels', 'id'));
    }
    public function store(Request $request, MemberHasProgramClass $memberHasProgramClass)
    {
        $request->validate(['method' => 'required']);
        try {
            $transaction = TripayService::requestTransaction($request->method, $memberHasProgramClass);
            // dd($transaction);
            $memberHasProgramClass->transactions()->create([
                'reference' => $transaction->reference,
                'merchant_ref' => $transaction->merchant_ref,
                'total_amount' => $transaction->amount,
                'status' => $transaction->status,
            ]);
            return redirect()->route('member.transaction.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function index()
    {
        $member = auth()->user()->member;
        $transactions = [];
        foreach ($member->memberHasProgramClass as $memperProgramClass) {
            foreach ($memperProgramClass->transactions as $transaction) {
                array_push($transactions, $transaction);
            }
        }
        return view('app.member.transaction.index', compact('transactions'));
    }
    public function show($reference)
    {
        $transaction = TripayService::detailTransaction($reference);
        return view('app.member.transaction.show', compact('transaction'));
    }
    public function charge(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, env('TRIPAY_PRIVATE_KEY'));
        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $uniqueRef = $data->merchant_ref;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $invoice = Transaction::where('merchant_ref', $uniqueRef)
                ->where('status', '=', 'UNPAID')
                ->first();

            if (!$invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $uniqueRef,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'PAID']);
                    $invoice->memberHasProgramClass()->update([
                        'status' => 'aktif',
                        'tanggal_kadaluarsa' => Carbon::now()->addMonths($invoice->memberHasProgramClass->berlangganan_selama)
                    ]);
                    break;

                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }
            return Response::json(['success' => true]);
        }
    }
}
