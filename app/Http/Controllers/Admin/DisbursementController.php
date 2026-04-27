<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisbursementController extends Controller
{
    /** Admin disburses funds to a student wallet after they accept */
    public function disburse(Application $application)
    {
        if ($application->status !== 'completed' || $application->disbursed_at) {
            return redirect()->back()->with('error', 'This application has already been disbursed or is not eligible.');
        }

        $application->loadMissing('scholarship', 'student', 'donator');

        $amount = (float) ($application->awarded_amount > 0
            ? $application->awarded_amount
            : $application->scholarship->amount ?? 0);

        if ($amount <= 0) {
            return redirect()->back()->with('error', 'No award amount set for this application.');
        }

        DB::beginTransaction();
        try {
            // Credit student wallet
            $wallet = $application->student->getOrCreateWallet();
            $wallet->credit(
                $amount,
                'Scholarship disbursement: ' . ($application->scholarship->name ?? 'Scholarship'),
                $application->id
            );

            // Deduct from donor's available fund
            if ($application->donator) {
                $application->donator->decrement('available_fund', $amount);
            }

            $application->disbursed_at = now();
            $application->disbursed_by = auth()->id();
            $application->save();

            DB::commit();
            return redirect()->back()->with('success', '₱' . number_format($amount, 2) . ' disbursed to ' . ($application->student->user->name ?? 'student') . ' successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Disbursement failed. Please try again.');
        }
    }

    /** List all pending withdrawal requests */
    public function withdrawals()
    {
        $pending   = WalletTransaction::with(['wallet.student.user'])
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->latest()
            ->paginate(20, ['*'], 'pending_page');

        $processed = WalletTransaction::with(['wallet.student.user'])
            ->where('type', 'withdrawal')
            ->whereIn('status', ['completed', 'rejected'])
            ->latest()
            ->paginate(20, ['*'], 'processed_page');

        return view('admin.disbursements.withdrawals', compact('pending', 'processed'));
    }

    /** Approve a withdrawal request */
    public function approveWithdrawal(WalletTransaction $transaction)
    {
        if ($transaction->type !== 'withdrawal' || $transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'This withdrawal cannot be approved.');
        }

        $transaction->status      = 'completed';
        $transaction->approved_at = now();
        $transaction->approved_by = auth()->id();
        $transaction->save();

        return redirect()->back()->with('success', 'Withdrawal of ₱' . number_format($transaction->amount, 2) . ' approved.');
    }

    /** Reject a withdrawal request and refund the balance */
    public function rejectWithdrawal(Request $request, WalletTransaction $transaction)
    {
        $request->validate(['reason' => 'nullable|string|max:255']);

        if ($transaction->type !== 'withdrawal' || $transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'This withdrawal cannot be rejected.');
        }

        DB::beginTransaction();
        try {
            // Refund balance
            $wallet = $transaction->wallet;
            $wallet->balance         += $transaction->amount;
            $wallet->total_withdrawn -= $transaction->amount;
            $wallet->save();

            $transaction->status           = 'rejected';
            $transaction->approved_at      = now();
            $transaction->approved_by      = auth()->id();
            $transaction->rejection_reason = $request->reason ?? 'Rejected by admin';
            $transaction->save();

            DB::commit();
            return redirect()->back()->with('success', 'Withdrawal rejected and ₱' . number_format($transaction->amount, 2) . ' refunded to student wallet.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to reject withdrawal.');
        }
    }
}
