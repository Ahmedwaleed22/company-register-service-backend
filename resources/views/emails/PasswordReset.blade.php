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
                                <img width="200" src="/imgs/logo.png" alt="Domaino Startup" />
                            </a>
                        </center>
                    </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:8px 25px;word-break:break-word">
                  <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381">
                    We received a request to reset the password for your account. If you did not make this request, please ignore this email. Otherwise, click the button below to reset your password:
                  </div>
                  </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%">
                    <tbody>
                      <tr>
                        <td align="center" bgcolor="rgb(21, 156, 201)" role="presentation" style="border:none;border-radius:3px;background:rgb(21, 156, 201)" valign="middle">
                        <a href="{{ env('FRONTEND_URL') }}/resetpassword/{{ $token }}" style="display:inline-block;background:rgb(21, 156, 201);color:#ffffff;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:17px;font-weight:bold;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;border-radius:3px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.1stformations.co.uk/login/?k%3DDexgXhoOT8uWyMtsQ%252Fqwh1wO9bkNbskk%252FIOrN3j1wI3OWaWiGNYSw%252BknGwEC5JgSWXSLIBicHF8W8feukc%252B2WkOQopBeWJ%252FNAYO6%252BJfp2NHJWewHk5lxvhYqDS06dGmYonG3Cde2G4NR1f5QlBDlNEcu5XYwTKwe4JvOai7rL56IDC167gYJ0xSZOxPPJkPKME%252FWIKJ%252F3XDsmDQvHTGS%252BKhSNFyLo4n5JMCm17FkgpgiGKX%252FxfkvLINb0kdGT7pCUZGAJEErY9T2tnV71U1AGvSDGbswO4lFMH7PPTBChU%252B%252F13slW%252Fz%252BarscvAkxgV5Twsx4roSw8wNK7GtPJ9%252B95Rj9YHH2WMnDSadSFaxss88%253D&amp;source=gmail&amp;ust=1692276166128000&amp;usg=AOvVaw35k0u4R9RC59JMxjYpt_bw">
                          Reset Password
                        </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
