<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, sans-serif;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
        <tr>
            <td align="center">

                <!-- Main Card -->
                <table width="500" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#4f46e5; padding:20px; text-align:center; color:#fff;">
                            <h2 style="margin:0;">Reset Your Password</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#333;">
                            <p style="font-size:16px;">Hello,</p>

                            <p style="font-size:14px; line-height:1.6;">
                                We received a request to reset your password. Click the button below to set a new password.
                            </p>

                            <!-- Button -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ $data['url'] }}"
                                   style="background:#4f46e5; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:6px; font-size:14px; display:inline-block;">
                                    Reset Password
                                </a>
                            </div>

                            <p style="font-size:13px; color:#666;">
                                If you didn’t request this, you can safely ignore this email.
                            </p>

                            <p style="font-size:13px; color:#666;">
                                This link will expire in 60 minutes for security reasons.
                            </p>

                            <p style="margin-top:20px; font-size:14px;">
                                Regards,<br>
                                <strong>Your Company Team</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#999;">
                            © 2026 Your Company. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
