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
                            I hope this email finds you well. We would like to inform you about an important update
                            regarding your recent order with {{ $company->name }}. We regret to inform you that your
                            order, {{ $order->id }}, has been canceled due to unforeseen circumstances. We understand
                            that this may be disappointing, and we sincerely apologize for any inconvenience this may
                            have caused you.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We understand the importance of a smooth and hassle-free shopping experience, and we are
                            committed to ensuring your satisfaction. As a result of the order cancellation, we have
                            processed a refund for the full amount of your purchase. The refund has been initiated to
                            the original payment method you used during the order placement.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Please note that it may take up to 7 working days for the refunded amount to reflect in your
                            account. The exact duration may vary depending on your bank or financial institution's
                            policies and processing times. We kindly ask for your patience during this period and assure
                            you that we are closely monitoring the refund process to ensure it is completed as swiftly
                            as possible.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We understand that this experience may not have met your expectations, and we sincerely
                            apologize for any inconvenience you may have faced. At {{ $company->name }}, customer
                            satisfaction is our top priority, and we value your feedback and loyalty. We are
                            continuously working to improve our services to provide you with a better shopping
                            experience in the future.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            We hope this incident does not deter you from considering us for your future shopping needs.
                            We would be thrilled to serve you again and provide you with the excellent service that you
                            deserve. If you have any questions, concerns, or require further assistance, please do not
                            hesitate to reach out to our customer support team at online@domainostartup.com or
                            442032900048. Our dedicated team is here to assist you in any way possible.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Once again, we sincerely apologize for any inconvenience this may have caused you, and we
                            look forward to the opportunity to serve you better in the future. Thank you for choosing
                            {{ $company->name }} for your shopping needs.
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
