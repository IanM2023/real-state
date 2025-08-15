<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <style>
    body {
      background: linear-gradient(to right, #00c6ff, #0072ff);
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .reset-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      box-sizing: border-box;
      text-align: center;
    }

    .reset-box h2 {
      margin-bottom: 20px;
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .form-group span {
      display: block;
      color: red;
      font-size: 14px;
      margin-top: 5px;
      width: 100%;
    }

    .form-group button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      border: none;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form-group button:hover {
      background-color: #0056b3;
    }
    
  </style>
</head>
<body>
  <div class="reset-box">
    <h2>Reset Password</h2>
    <form method="POST" action="{{ url('set_new_password/' .$token) }}">
      @csrf
      <div class="form-group">
        <input type="password" name="password" placeholder="Enter New Password" required>
        <span>{{ $errors->first('password') }}</span>
      </div>
      <div class="form-group">
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <span>{{ $errors->first('confirm_password') }}</span>
      </div>
      <div class="form-group">
        <button type="submit">Reset Password</button>
      </div>
    </form>
  </div>
</body>
</html>
