<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f6f8; padding: 40px 10px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #e9ecef;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #198754; padding: 28px 30px; text-align: left;">
                            <span style="background-color: rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; letter-spacing: 0.5px;">Contact Notification</span>
                            <h1 style="color: #ffffff; font-size: 22px; font-weight: 700; margin: 10px 0 0 0;">New Message Received</h1>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 15px; color: #495057; margin-top: 0; margin-bottom: 24px; line-height: 1.5;">
                                Hello, you have received a new inquiry via your website contact form from <strong style="color: #212529;">{{ $name }}</strong>.
                            </p>

                            <!-- User Details Section -->
                            <div style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef; padding: 20px; margin-bottom: 24px;">
                                <h2 style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: #6c757d; letter-spacing: 0.5px; margin: 0 0 16px 0;">
                                    User Details
                                </h2>

                                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 14px; color: #333333;">
                                    <tr>
                                        <td width="100" style="padding-bottom: 10px; color: #6c757d; font-weight: 600;">Name:</td>
                                        <td style="padding-bottom: 10px; font-weight: 600; color: #212529;">{{ $name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 10px; color: #6c757d; font-weight: 600;">Email:</td>
                                        <td style="padding-bottom: 10px;">
                                            <a href="mailto:{{ $email }}" style="color: #198754; text-decoration: none; font-weight: 600;">{{ $email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 10px; color: #6c757d; font-weight: 600;">Phone:</td>
                                        <td style="padding-bottom: 10px; color: #212529;">
                                            <a href="tel:{{ $phone }}" style="color: #212529; text-decoration: none;">{{ $phone ?? 'N/A' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #6c757d; font-weight: 600;">Subject:</td>
                                        <td style="color: #212529; font-weight: 600;">{{ $subject }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Message Area -->
                            <div style="margin-bottom: 10px;">
                                <h2 style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: #6c757d; letter-spacing: 0.5px; margin: 0 0 8px 0;">
                                    Message
                                </h2>
                                <div style="background-color: #ffffff; border-left: 4px solid #198754; border-top: 1px solid #e9ecef; border-right: 1px solid #e9ecef; border-bottom: 1px solid #e9ecef; border-radius: 0 8px 8px 0; padding: 16px; font-size: 14px; line-height: 1.6; color: #212529;">
                                    {!! nl2br(e($user_query)) !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; border-top: 1px solid #e9ecef; text-align: center;">
                            <p style="font-size: 12px; color: #6c757d; margin: 0; line-height: 1.5;">
                                This email was generated automatically from your website contact form.
                            </p>
                            <p style="font-size: 12px; color: #adb5bd; margin: 6px 0 0 0;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Your Company') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>