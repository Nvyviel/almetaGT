<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - AlmetaGT</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }
        .header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .content h2 {
            color: #1e40af;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .content p {
            margin-bottom: 16px;
            color: #4a5568;
            font-size: 16px;
        }
        .reset-button {
            display: inline-block;
            background: #1e40af;
            color: white !important;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.3s;
        }
        .reset-button:hover {
            background: #1e3a8a;
        }
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 20px;
            margin: 24px 0;
        }
        .info-box h3 {
            color: #1e40af;
            margin: 0 0 8px 0;
            font-size: 18px;
        }
        .info-box p {
            margin: 0;
            font-size: 14px;
            color: #1e3a8a;
        }
        .footer {
            background: #f7fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 8px 0;
            font-size: 14px;
            color: #718096;
        }
        .footer .support-info {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
            display: inline-block;
        }
        .footer .support-info strong {
            color: #1e40af;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 0 10px;
            }
            .header {
                padding: 30px 15px;
            }
            .content {
                padding: 30px 20px;
            }
            .footer {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>AlmetaGT</h1>
            <p>Shipping Management System</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2>Reset Your Password</h2>
            
            <p>Hello {{ $user->name ?? 'User' }},</p>
            
            <p>You are receiving this email because we received a password reset request for your AlmetaGT account.</p>
            
            <p>Click the button below to reset your password:</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $url }}" class="reset-button">Reset Password</a>
            </div>
            
            <div class="info-box">
                <h3>🔒 Security Information</h3>
                <p><strong>This password reset link will expire in {{ $count }} minutes.</strong></p>
                <p>If you did not request a password reset, no further action is required and your password will remain unchanged.</p>
            </div>
            
            <p>If the button above doesn't work, you can copy and paste the following link into your browser:</p>
            <p style="word-break: break-all; background: #f7fafc; padding: 12px; border-radius: 4px; font-size: 14px; color: #1e40af;">
                {{ $url }}
            </p>
            
            <p>For security reasons, this link is unique to your account and should not be shared with anyone.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="support-info">
                <p><strong>Need Help?</strong></p>
                <p>📧 Email: support@almetagt.com</p>
                <p>📞 Phone: +62 XXX-XXXX-XXXX</p>
                <p>⏰ Support Hours: Monday - Friday, 9:00 AM - 6:00 PM</p>
            </div>
            
            <p>This email was sent from AlmetaGT Password Reset System.</p>
            <p>&copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.</p>
            <p style="font-size: 12px; color: #a0aec0;">
                If you're having trouble clicking the "Reset Password" button, copy and paste the URL above into your web browser.
            </p>
        </div>
    </div>
</body>
</html>