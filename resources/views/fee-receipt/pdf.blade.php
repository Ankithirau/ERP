<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Fee Receipt</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px; margin: 0; padding: 10px 0px;">

    <div style="width: 700px; margin: auto; padding: 20px; border: 1px solid #ddd;">
        <!-- Header Section -->
        <div style="display: flex; justify-content: center; align-items: center; padding-bottom: 10px; border-bottom: 2px solid orange;">
            <div style="text-align: center;">
                <img src="http://16.171.242.61/sdrecord/img/springdalelogo.png" alt="School Logo"
                    style="max-width: 60px; display: block; margin: 0 auto;">
                <h1 style="color: orange; margin: 5px 0; font-size: 18px;">Sunny's SPRING DALE SCHOOL</h1>
                <p style="margin: 2px 0; font-size: 12px;">(CBSE) Affiliation No. 1130268</p>
                <p style="margin: 2px 0; font-size: 12px;">Krishna Nagari, Khat Road, Bhandara - 441904</p>
                <h3 style="margin-top: 10px; font-size: 16px;">STUDENT FEES RECEIPT</h3>
            </div>
        </div>

        <!-- Info Section -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 14px; border: 1px solid #ccc;">
            <tr>
                <td style="padding: 6px; border: 1px solid #ccc;"><strong>Rec. No:</strong> {{ $data['receipt_no'] }}</td>
                <td style="padding: 6px; border: 1px solid #ccc; text-align: left;"><strong>Date:</strong> {{ $data['payment_date'] }}</td>
            </tr>
            <tr>
                <td style="padding: 6px; border: 1px solid #ccc;"><strong>Name:</strong> {{ $data['student_name'] }}</td>
                <td style="padding: 6px; border: 1px solid #ccc; text-align: left;"><strong>Student Id:</strong> {{ $data['student_id'] }}</td>
            </tr>
            <tr>
                <td style="padding: 6px; border: 1px solid #ccc;"><strong>Class:</strong> {{ $data['class'] }}</td>
                <td style="padding: 6px; border: 1px solid #ccc; text-align: left;"><strong>Section:</strong> {{ $data['section'] }}</td>
            </tr>
            <!-- Payment Details -->
            <tr>
                <td style="padding: 6px; border: 1px solid #ccc;"><strong>Payment Mode:</strong> {{ $data['payment_mode'] }}</td>
                <td style="padding: 6px; border: 1px solid #ccc; text-align: left;">
                    <strong>Payment Info:</strong> {{ $data['payment_info'] ?? 'N/A' }}
                </td>
            </tr>
        </table>

        <!-- Fees Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px;">
            <tr>
                <th style="border: 1px solid #ccc; padding: 6px; text-align: left; background-color: orange; color: white;">Sr. No.</th>
                <th style="border: 1px solid #ccc; padding: 6px; text-align: left; background-color: orange; color: white;">Fee Name</th>
                <th style="border: 1px solid #ccc; padding: 6px; text-align: left; background-color: orange; color: white;">Amount</th>
            </tr>
            @php
            $feesDetails = is_string($data['fees_details']) ? json_decode($data['fees_details'], true) : $data['fees_details'];
            @endphp
            @foreach($feesDetails as $index => $fee)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">{{ $fee['name'] }}</td>
                    <td style="border: 1px solid #ccc; padding: 6px;"> {{ number_format($fee['amount'], 2) }}</td>
                </tr>
            @endforeach
        </table>

        <!-- Total Fees Section -->
        <div style="margin-top: 15px; font-size: 16px; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
            <span>Total Fees Paid:</span>
            <span>Rs. ***{{ number_format($data['amount'], 2) }}***</span>
        </div>

        <div style="margin-top: 5px; font-size: 14px; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
            <span>Amount in Words:</span>
            <span>{{ ucwords((new NumberFormatter('en', NumberFormatter::SPELLOUT))->format($data['amount'])) }} Only</span>
        </div>

        <!-- Stamp and Signature -->
        <div style="margin-top: 20px; font-size: 12px; text-align: left;">
            Sunny's Spring Dale School, Bhandara<br>
            AG. No. 1130268
        </div>
        <div style="text-align: right; font-weight: bold; margin-top: 10px;">Signature</div>
    </div>
</body>
</html>
