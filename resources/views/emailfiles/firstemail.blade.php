<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:20px;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.05);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#4f46e5; padding:20px; text-align:center; color:#ffffff;">
                            <h2 style="margin:0;">{{ $data['school'] }}</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:20px; color:#333333;">

                            <p style="margin-bottom:10px;">
                                <strong>To:</strong> {{ $data['principale'] }}
                            </p>

                            <p style="margin-bottom:20px;">
                                <strong>Message:</strong>
                            </p>

                            <div style="background:#f9fafb; padding:15px; border-radius:6px; line-height:1.6;">
                                {{ $data['message'] }}
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#888;">
                            © {{ date('Y') }} SC & ST Welfare Department
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
