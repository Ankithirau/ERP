<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeesReceipt;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class FeesReceiptController extends Controller
{
    public function generateReceipt(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
            'class' => 'required|string|max:20',
            'section' => 'required|string|max:5',
            'fees' => 'required|array',
            'fees.*.name' => 'required|string|max:255',
            'fees.*.amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_mode' => 'required|string|max:50'
        ], [
            'student_name.required' => 'Student Name is required. Please enter the full name of the student.',
            'student_id.required' => 'Student ID is required. Ensure you enter a valid Student ID.',
            'class.required' => 'Class field cannot be empty. Please select the appropriate class.',
            'section.required' => 'Section is required. Kindly specify the correct section.',
            'fees.required' => 'At least one additional fee must be added.'
        ]);

        try {

            $totalFees = array_sum(array_column($request->fees, 'amount'));

            $data = [
                'receipt_no' => '2024-25/' . rand(1000, 9999),
                'student_name' => $request->student_name,
                'student_id' => $request->student_id,
                'class' => $request->class,
                'section' => $request->section,
                'fees_details' => json_encode($request->fees), // JSON को Array में बदलें
                'amount' => $totalFees,
                'payment_date' => $request->payment_date,
                'payment_mode' => $request->payment_mode
            ];

            $pdf = PDF::loadView('fee-receipt.pdf', compact('data'))->setPaper('A4', 'portrait');
            $pdfPath = 'receipts/' . $data['student_id'] . '_receipt.pdf';
            Storage::put('public/' . $pdfPath, $pdf->output());

            FeesReceipt::create([
                'receipt_no' => $data['receipt_no'],
                'student_name' => $data['student_name'],
                'student_id' => $data['student_id'],
                'class' => $data['class'],
                'section' => $data['section'],
                'fees_details' => $data['fees_details'],
                'amount' => $data['amount'],
                'payment_date' => $data['payment_date'],
                'payment_mode' => $data['payment_mode'],
                'pdf_path' => $pdfPath
            ]);

            return back()->with('success', 'Receipt generated successfully!');
        } catch (\Throwable $th) {
            return back()->with('success', $th->getMessage());
        }
    }

    public function receiptIndex()
    {
        $receipts = FeesReceipt::orderBy('payment_date', 'desc')->paginate(10);
        return view('fee-receipt.index', compact('receipts'));
    }

    public function receiptCreate()
    {
        $students = Student::select('student_id', 'name')->get();
        $receipts = FeesReceipt::orderBy('payment_date', 'desc')->paginate(10);
        return view('fee-receipt.create', compact('receipts','students'));
    }
    public function receiptEdit($id)
    {
        $receipt = FeesReceipt::findOrFail($id);
        $receipt->fees_details = json_decode($receipt->fees_details, true);
        $students = Student::select('student_id', 'name')->get();
        return view('fee-receipt.edit', compact('receipt', 'students'));
    }

    public function updateReceipt(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
            'class' => 'required|string|max:20',
            'section' => 'required|string|max:5',
            'fees' => 'required|array',
            'fees.*.name' => 'required|string|max:255',
            'fees.*.amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_mode' => 'required|string|max:50'
        ]);

        try {
            $receipt = FeesReceipt::findOrFail($id);

            $totalFees = array_sum(array_column($request->fees, 'amount'));

            $data = [
                'receipt_no' => $receipt->receipt_no,
                'student_name' => $request->student_name,
                'student_id' => $request->student_id,
                'class' => $request->class,
                'section' => $request->section,
                'fees_details' => json_encode($request->fees),
                'amount' => $totalFees,
                'payment_date' => $request->payment_date,
                'payment_mode' => $request->payment_mode
            ];

            // ✅ Existing PDF Update
            $pdf = PDF::loadView('fee-receipt.pdf', compact('data'))->setPaper('A4', 'portrait');
            $pdfPath = 'receipts/' . $data['student_id'] . '_receipt.pdf';
            Storage::put('public/' . $pdfPath, $pdf->output());

            $receipt->update([
                'student_name' => $data['student_name'],
                'student_id' => $data['student_id'],
                'class' => $data['class'],
                'section' => $data['section'],
                'fees_details' => $data['fees_details'],
                'amount' => $data['amount'],
                'payment_date' => $data['payment_date'],
                'payment_mode' => $data['payment_mode'],
                'pdf_path' => $pdfPath
            ]);

            return back()->with('success', 'Receipt updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function downloadReceipt($id)
    {
        $receipt = FeesReceipt::findOrFail($id);

        if (!$receipt->pdf_path || !Storage::exists('public/' . $receipt->pdf_path)) {
            return back()->with('error', 'Receipt PDF not found.');
        }

        return response()->download(storage_path("app/public/" . $receipt->pdf_path));
    }

    public function deleteReceipt($id)
    {
        try {
            $receipt = FeesReceipt::findOrFail($id);

            if ($receipt->pdf_path && Storage::exists('public/' . $receipt->pdf_path)) {
                Storage::delete('public/' . $receipt->pdf_path);
            }

            $receipt->delete();

            return back()->with('success', 'Receipt deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting receipt: ' . $e->getMessage());
        }
    }


    public function showReceipt(Request $request)
    {
        $receipt = FeesReceipt::findOrFail(2);


        $totalFees = array_sum(array_column($receipt->fees_details, 'amount'));

        $data = [
            'receipt_no' => '2024-25/' . rand(1000, 9999),
            'student_name' => $receipt->student_name,
            'student_id' => $receipt->student_id,
            'class' => $receipt->class,
            'section' => $receipt->section,
            'fees_details' => $receipt->fees, // Array format for easy access
            'amount' => $totalFees,
            'payment_date' => $receipt->payment_date,
            'payment_mode' => $receipt->payment_mode
        ];

        // Generate PDF
        $pdf = Pdf::loadView('fee-receipt.pdf', compact('data'))->setPaper('A4', 'portrait');;

        // **OPTION 1: Show PDF in Browser**
        return $pdf->stream('fee_receipt.pdf');

        // **OPTION 2: Force Download PDF**
        // return $pdf->download('fee_receipt.pdf');
    }
}



