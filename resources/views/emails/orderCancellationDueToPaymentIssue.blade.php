<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Cancellation</title>
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
                            I hope this email finds you well. We regret to inform you that your recent order with
                            {{ $company->name }}, Order Number {{ $order->id }}, has been canceled due to a payment
                            issue.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We understand that you may have encountered difficulties during the payment process, and we
                            genuinely apologize for any inconvenience this may have caused you. It is important to us
                            that you have a seamless and hassle-free shopping experience, and we are here to assist you
                            in resolving this matter.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            If you wish to complete your order, we kindly ask you to review your payment information and
                            ensure that it is accurate. Once you have verified your payment details, you can place a new
                            order on our website. If you require any assistance or have any questions regarding the
                            payment process, please do not hesitate to contact our customer support team at
                            online@domainostartup.com or 442032900048. Our team is ready to assist you in any way
                            possible.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We understand that this situation may be frustrating, and we sincerely apologize for any
                            inconvenience it may have caused. Your satisfaction is our top priority, and we are
                            committed to making your shopping experience with us as smooth as possible.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We appreciate your interest in {{ $company->name }}, and we hope that you will consider
                            giving us another opportunity to serve you in the future. If you have any further inquiries
                            or need assistance with anything else, please feel free to reach out to us. We are here to
                            help.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Once again, we apologize for any inconvenience caused by the order cancellation, and we look
                            forward to the possibility of serving you again.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;padding-bottom:0;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Best regards,
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
