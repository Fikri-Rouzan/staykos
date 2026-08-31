<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        $transaction = Transaction::where('code', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $fromNumber = getenv("TWILIO_WHATSAPP_NUMBER");
        $twilio = new Client($sid, $token);

        $message =
            "Hello, " . $transaction->name . "!" . PHP_EOL . PHP_EOL .
            "We have received your payment with the booking code: " . $transaction->code . "." . PHP_EOL .
            "Total payment: Rp " . number_format($transaction->total_amount, 0, ',', '.') . PHP_EOL . PHP_EOL .
            "You can come to the boarding house: " . $transaction->boardingHouse->name . PHP_EOL .
            "Address: " . $transaction->boardingHouse->address . PHP_EOL .
            "Starting date: " . date('d-M-Y', strtotime($transaction->start_date)) . PHP_EOL . PHP_EOL .
            "Thank you for your trust! 😊" . PHP_EOL .
            "We look forward to your arrival.";

        switch ($transactionStatus) {
            case 'capture':
                if ($request->payment_type == 'credit_card') {
                    if ($request->fraud_status == 'challenge') {
                        $transaction->update(['payment_status' => 'pending']);
                    } else {
                        $transaction->update(['payment_status' => 'success']);
                    }
                }
                break;
            case 'settlement':
                $transaction->update(['payment_status' => 'success']);

                $twilio->messages
                    ->create(
                        "whatsapp:+" . $transaction->phone,
                        array(
                            "from" => $fromNumber,
                            "body" => $message
                        )
                    );

                break;
            case 'pending':
                $transaction->update(['payment_status' => 'pending']);
                break;
            case 'deny':
                $transaction->update(['payment_status' => 'failed']);
                break;
            case 'expire':
                $transaction->update(['payment_status' => 'expired']);
                break;
            case 'cancel':
                $transaction->update(['payment_status' => 'canceled']);
                break;
            default:
                $transaction->update(['payment_status' => 'unknown']);
                break;
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}
