<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentWalletController extends Controller
{
    private function getStudent()
    {
        return Student::where('user_id', auth()->id())->first();
    }

    public function index()
    {
        $student = $this->getStudent();
        if (!$student) return redirect()->route('student.dashboard')->with('error', 'Student profile not found.');

        $wallet = $student->getOrCreateWallet();
        $transactions = $wallet->transactions()->latest()->paginate(10);

        return view('student.wallet.index', compact('wallet', 'transactions'));
    }

    public function withdrawForm()
    {
        $student = $this->getStudent();
        if (!$student) return redirect()->route('student.dashboard')->with('error', 'Student profile not found.');

        $wallet = $student->getOrCreateWallet();
        return view('student.wallet.withdraw', compact('wallet'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:1',
            'method'         => 'required|in:gcash,maya,bank',
            'account_name'   => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'bank_name'      => 'required_if:method,bank|nullable|string|max:100',
        ]);

        $student = $this->getStudent();
        $wallet  = $student->getOrCreateWallet();

        if (!$wallet->canWithdraw((float) $request->amount)) {
            return redirect()->back()->with('error', 'Insufficient balance.');
        }

        DB::beginTransaction();
        try {
            // Deduct balance
            $wallet->balance          -= $request->amount;
            $wallet->total_withdrawn  += $request->amount;
            $wallet->save();

            // Record transaction
            $wallet->transactions()->create([
                'type'           => 'withdrawal',
                'amount'         => $request->amount,
                'status'         => 'pending',
                'description'    => 'Withdrawal via ' . strtoupper($request->method),
                'method'         => $request->method,
                'account_name'   => $request->account_name,
                'account_number' => $request->account_number,
                'bank_name'      => $request->bank_name,
            ]);

            DB::commit();
            return redirect()->route('student.wallet.index')
                ->with('success', 'Withdrawal request submitted! Funds will be sent to your ' . strtoupper($request->method) . ' account within 1-3 business days.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Withdrawal failed. Please try again.');
        }
    }
}
