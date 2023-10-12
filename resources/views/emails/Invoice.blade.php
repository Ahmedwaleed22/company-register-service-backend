<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
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
                                <img width="200" src="{{ env('FRONTEND_URL') }}/imgs/logo.png" alt="Domaino Startup" />
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
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:20px;font-weight:bold;line-height:24px;text-align:left;color:#637381">
                            Order Confirmation
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Thank you for your order. We are reaching you just to confirm that you have completed an order on <a style="color:rgb(21, 156, 201)" href="https://domainostartup.com">Domaino Startup</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            Please accept this email as confirmation of your order is now in progress. Should you wish
                            to contact us regarding this order, please do so using the details at the bottom of this
                            email and quoting your order reference details:
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            <ol>
                                <li>
                                    <strong>Order Number:</strong> {{ $order->id }}
                                </li>
                            </ol>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                        <div
                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                            For confirmation, you have ordered the following products and services:
                        </div>
                    </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                    <div
                        style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                        {{ $company->name }}<br>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                  <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                    Company formation orders: Companies House usually take around 3 to 4 working days to process a new company application, however, this is subject to Companies House workload, and sometimes it can take up to 6 working days. Companies House only process applications between 8.30am and 5.00pm Monday to Friday.
                  </div>
                  </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                  <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                    Many thanks for choosing Domaino Startup today!
                  </div>
                  </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:8px 25px;padding-bottom:0;word-break:break-word">
                  <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                    Kind regards,
                  </div>
                  </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:8px 25px 30px;word-break:break-word">
                  <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
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
