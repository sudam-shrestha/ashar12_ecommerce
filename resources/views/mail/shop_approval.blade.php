<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shop Has Been Approved!</title>
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
            background-color: #28a745;
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
        .credentials {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
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
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
        .warning {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Congratulations! Your Shop Has Been Approved</h2>
    </div>

    <div class="content">
        <p>Dear {{ $shop->name }},</p>
        <p>We're pleased to inform you that your shop <strong>{{ $shop->shop_name }}</strong> has been approved and is now active on our platform.</p>

        <div class="credentials">
            <h3 style="margin-top: 0;">Your Login Credentials</h3>
            <div class="detail-row">
                <span class="label">Login URL:</span>
                <span><a href="{{ url('/shop/login') }}">{{ url('/shop/login') }}</a></span>
            </div>
            <div class="detail-row">
                <span class="label">Email:</span>
                <span>{{ $shop->email }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Password:</span>
                <span>{{ $password }}</span>
            </div>
            <p class="warning">For security reasons, we recommend changing your password after first login.</p>
        </div>

        <p>You can now log in to your shop dashboard to start managing your shop, adding products, and processing orders.</p>

        <div style="text-align: center;">
            <a href="{{ url('/shop/login') }}" class="action-btn">Access Your Vendor Dashboard</a>
        </div>

        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>

        <p>Welcome aboard!</p>
        <p><strong>The CODE IT Team</strong></p>
    </div>

    <div class="footer">
        <p>This is an automated notification. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} CODE IT. All rights reserved.</p>
    </div>
</body>
</html>
