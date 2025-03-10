<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Fee Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .receipt { width: 700px; margin: auto; padding: 20px; border: 1px solid #ddd; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .header img { max-width: 100px; }
        .header-content { text-align: right; }
        .header-content h1 { color: orange; margin: 5px 0; font-size: 18px; }
        .header-content p { margin: 2px 0; font-size: 12px; }
        .info { margin-top: 15px; border: 1px solid #ccc; padding: 10px; display: flex; flex-wrap: wrap; }
        .info div { width: 50%; font-size: 14px; padding: 3px 0; }
        .left { text-align: left; } .right { text-align: right; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .table th { background-color: orange; color: white; }
        .total { margin-top: 15px; font-size: 16px; font-weight: bold; text-align: right; }
        .stamp { margin-top: 20px; font-size: 12px; text-align: right; }
        .signature { text-align: right; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <img src="http://16.171.242.61/sdrecord/img/springdalelogo.png" alt="School Logo">
            <div class="header-content">
                <h1>Sunny's SPRING DALE SCHOOL</h1>
                <p>(CBSE) Affiliation No. 1130268</p>
                <p>Krishna Nagari, Khat Road, Bhandara - 441904</p>
                <h3>STUDENT FEES RECEIPT</h3>
            </div>
        </div>

        <div class="info">
            <div class="left"><strong>Rec. No:</strong> {{ $data['receipt_no'] }}</div>
            <div class="right"><strong>Date:</strong> {{ $data['payment_date'] }}</div>
            <div class="left"><strong>Name:</strong> {{ $data['student_name'] }}</div>
            <div class="right"><strong>Id:</strong> {{ $data['student_id'] }}</div>
            <div class="left"><strong>Class:</strong> {{ $data['class'] }}</div>
            <div class="right"><strong>Section:</strong> {{ $data['section'] }}</div>
        </div>

        <table class="table">
            <tr>
                <th>Sr. No.</th>
                <th>Fee Name</th>
                <th>Amount</th>
            </tr>
            @php
                $feesDetails = is_string($data['fees_details']) ? json_decode($data['fees_details'], true) : $data['fees_details'];
            @endphp

            @foreach($feesDetails as $index => $fee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $fee['name'] }}</td>
                    <td> ₹ {{ number_format($fee['amount'], 2) }}</td>
                </tr>
            @endforeach
        </table>

        <div class="total">
            Total Fees Paid: ₹ ***{{ number_format($data['amount'], 2) }}***
        </div>

        <div class="total">
            {{ ucwords((new NumberFormatter('en', NumberFormatter::SPELLOUT))->format($data['amount'])) }} Only
        </div>

        <div class="stamp">
            Sunny's Spring Dale School, Bhandara<br>
            AG. No. 1130268
        </div>
        <div class="signature">Signature</div>
    </div>
</body>
</html>
