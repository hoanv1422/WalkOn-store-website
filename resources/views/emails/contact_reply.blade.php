<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi từ hệ thống admin WalkOn</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            text-align: center;
        }
        table.container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 600;
            margin: 0 0 25px 0;
        }
        p {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.8;
            margin: 15px 0;
        }
        .btn {
            background: linear-gradient(135deg, #007bff, #00b4d8);
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 25px;
            display: inline-block;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            border: none;
        }
        .btn:hover {
            background: linear-gradient(135deg, #0056b3, #0096c7);
            color: white;
        }
        .footer-text {
            margin-top: 30px;
            font-size: 14px;
            color: #95a5a6;
        }
        @media only screen and (max-width: 600px) {
            table.container {
                width: 100% !important;
                padding: 20px !important;
            }
        }
    </style>
</head>
<body>
    <table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td>
                <h2>Xin Chào !! {{ $contact->name }}!</h2>
                <p>Cảm ơn bạn đã liên hệ với WalkOn Shop. Dưới đây là phản hồi của chúng tôi 👇</p>
                <p style="color: green;">Trả lời: {{ $responseMessage }}</p>
                <p class="footer-text">Trân trọng,<br>Đội ngũ hỗ trợ khách hàng WalkOn</p>
            </td>
        </tr>
    </table>
</body>
</html>
