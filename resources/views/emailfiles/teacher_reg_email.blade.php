<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Teacher Login Details</title>
</head>

<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif;">


<table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff; border-radius:10px; overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td style="background:#4f46e5; color:#fff; text-align:center; padding:20px;">
                        <h2 style="margin:0;">Teacher Account Created</h2>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:30px; color:#333;">

                        <p>Hello 👋,</p>

                        <p>Your teacher account has been created successfully.</p>

                        <!-- Credentials Box -->
                        <table width="100%" cellpadding="10" cellspacing="0"
                               style="background:#f9fafb; border-radius:6px; margin:20px 0;">
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $data['email'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Password:</strong></td>
                                <td>{{ $data['password'] }}</td>
                            </tr>
                        </table>

                        <!-- Button -->
                        <div style="text-align:center; margin:25px 0;">
                            <a href="{{ $data['link'] }}"
                               style="background:#4f46e5; color:#fff; padding:12px 25px;
                                      text-decoration:none; border-radius:6px;">
                                Login Now
                            </a>
                        </div>

                        <p style="font-size:14px; color:#666;">
                            ⚠️ For security reasons, please change your password after first login.
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="text-align:center; padding:15px; font-size:12px; color:#888;">
                        © {{ date('Y') }} SCST Walfire
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>


</body>
</html>
