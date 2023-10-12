<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Completed</title>
    <style>
        body {
            margin: 0;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
        }

        table {
            border-spacing: 0;
        }

        td {
            padding: 0;
        }

        img {
            border: 0
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f0f0f0;
            padding-bottom: 60px;
        }

        .main {
            background: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 650px;
            border-spacing: 0;
            font-family: sans-serif;
            color: #000000;
        }

        .container {
            padding: 20px
        }

        .title {
            font-size: 22px
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <tbody>
                <tr>
                    <td height="8" style="background-color: #e72027"></td>
                </tr>
                <tr>
                    <td style="padding: 20px">
                        <center>
                            <a href="https://domainostartup.com">
                                <img width="200" src="{{ env('FRONTEND_URL') }}/imgs/logo.png"
                                    alt="Domaino Startup" />
                            </a>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
                            font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Dear {{ $user->first_name }} {{ $user->last_name }},
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We hope this email finds you well. We are thrilled to inform you that your recent order with
                            {{ $company->name }} has been successfully completed, and we are excited to share the
                            attached file with you.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Attached to this email, you will find the file associated with your order,
                            {{ $order->id }}.
                            Please feel free to download and review it at your convenience. If you have any questions or
                            require any further information regarding the contents of the file or your order, our
                            dedicated customer support team is here to assist you.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Your satisfaction is of utmost importance to us, and we genuinely appreciate your trust in
                            {{ $company->name }} for your needs. We are always looking for ways to enhance your
                            experience with us, and we would be honored to serve you again in the future.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            In addition to this email, we'd like to remind you that you have full control of your
                            account on our website. You can log in to your account to manage your orders, update your
                            profile, and access important documents and information related to your transactions. We
                            have also placed a copy of the document associated with your recent order in your dashboard
                            for easy reference.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            If you have any questions, concerns, or need further assistance, please don't hesitate to
                            reach out to us. Our customer support team is available to address any inquiries you may
                            have. You can contact us via email at online@domainostartup.com or through our website's
                            contact form. Alternatively, you can manage your account and access information directly by
                            logging in to your account on our website.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Once again, we appreciate your business and look forward to the opportunity to serve you
                            again. Thank you for choosing {{ $company->name }}.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;padding-bottom:0;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Warm regards,
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px 30px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            The Domaino Startup Team<br>
                            <br>
                            <b>Contact Us</b><br>
                            We are here to help.<br>
                            <a href="mailto:online@domainostartup.com" style="color:rgb(21, 156, 201)" target="_blank">
                                online@domainostartup.com
                            </a>
                            <br>
                            442032900048
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</body>

</html>
