<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vendor Request Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a6fa5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .detail-row {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .action-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4a6fa5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Vendor Request Received</h2>
    </div>

    <div class="content">
        <p>Hello Admin,</p>
        <p>A new vendor has submitted a request to join your platform. Below are the details:</p>

        <div class="details">
            <div class="detail-row">
                <span class="label">Vendor Name:</span>
                <span>{{ $shop->name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Shop Name:</span>
                <span>{{ $shop->shop_name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Email:</span>
                <span>{{ $shop->email }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Contact Number:</span>
                <span>{{ $shop->contact_number }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Shop Address:</span>
                <span>{{ $shop->shop_address }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Shop Type:</span>
                <span>{{ $shop->shop_type }}</span>
            </div>
        </div>

        <p>Please review this request and take appropriate action.</p>

        <div style="text-align: center; margin-top: 25px;">
            <a href="{{ url('/admin/shops') }}" class="action-btn">Review Request</a>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated notification. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </div>
</body>
</html>
