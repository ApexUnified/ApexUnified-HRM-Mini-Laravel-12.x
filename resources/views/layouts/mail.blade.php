@use("App\Models\Setting")
@php
    $setting = Setting::first();
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$setting->company_name}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #435ebe;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

    
        .logo {
            text-align: center;
            padding: 20px;
            background: #f8f8f8;
        }
        .content {
            padding: 20px;
            color: #333333;
            font-size: 16px;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666666;
        }
    </style>

    @yield("css")
</head>
<body>
    <div class="container">
        
        <!-- Logo Section -->
        <div class="logo">
          <h1>{{$setting->company_name}}</h1>
        </div>
        

        @yield("main-content")

        <!-- Footer Section -->
        <div class="footer">
            &copy; 2025 {{ $setting->company_name }} | All Rights Reserved
        </div>
    </div>
</body>
</html>
