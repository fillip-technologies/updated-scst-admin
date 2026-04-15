<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $data['subject'] }}</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f9; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#f4f6f9">
<tr>
<td align="center">

    <!-- Container -->
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; margin:30px auto; border-radius:8px; overflow:hidden;">

        <!-- Header -->
        <tr>
            <td style="background:#0d6efd; color:#ffffff; padding:20px; text-align:center;">
                <h2 style="margin:0;">📢 Notification Alert</h2>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding:30px; color:#333;">

                <p style="margin:0 0 10px;">Hello,</p>

                <h3 style="margin:10px 0; color:#0d6efd;">
                    {{ $data['subject'] }}
                </h3>

                <p style="line-height:1.6;">
                    {{ $data['message'] }}
                </p>

                <!-- Optional Receiver Info -->
                <p style="margin-top:20px; font-size:13px; color:#888;">
                    Sent to: {{ $data['reciver'] }}
                </p>

                <!-- Button (Optional) -->
                <div style="margin-top:25px;">
                    <a href="#" style="background:#0d6efd; color:#fff; padding:10px 18px; text-decoration:none; border-radius:5px; font-size:14px;">
                        View Details
                    </a>
                </div>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#666;">
                © {{ date('Y') }} Your Company <br>
                All rights reserved.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
