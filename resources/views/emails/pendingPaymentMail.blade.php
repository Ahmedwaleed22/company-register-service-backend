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
                            I hope this email finds you well. We wanted to update you regarding your recent order with
                            {{ $company->name }}. We have received your order, and we appreciate your decision to choose
                            our products/services.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            However, we have noticed that the payment for your order is currently pending. To ensure a
                            seamless processing and delivery experience, we kindly request that you complete the payment
                            at your earliest convenience. As soon as the payment is successfully processed, we will
                            immediately begin processing your order.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Here are the details of your order:<br><br>

                            - Order Number: {{ $order->id }}<br>
                            - Order Date: {{ $order->created_at }}<br>
                            - Items Ordered: {{ $company->name }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We understand that there may be various reasons for a pending payment, and we want to assist
                            you in resolving any issues that may have arisen during the payment process. If you require
                            any assistance or encounter any difficulties, please do not hesitate to contact our customer
                            support team at online@domainostartup.com or by replying to this email. We are here to help
                            you through the payment process and answer any questions you may have.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Once your payment is successfully completed, we will proceed with processing your order
                            promptly. We value your business and are committed to ensuring a smooth and satisfying
                            shopping experience with us.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Thank you again for choosing {{ $company->name }}. We look forward to fulfilling your order
                            and providing you with the excellent products/services you deserve. If you have any further
                            inquiries or need assistance, please feel free to reach out to us.
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
