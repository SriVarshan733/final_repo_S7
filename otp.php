<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Tutorial in JS</title>

    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <!-- Befor moving ahead please wheather you created credentials... -->
    <style>
        .form{
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            width: fit-content;
            margin: auto;
        }
        input{
            padding: 0.6rem;
        }
        .btn{
            padding: 0.5rem 0.8rem;
            background-color: violet;
            outline: none;
            border: none;
            cursor: pointer;
            border-radius: 16px;
        }
        .otpverify{
            display: none;
        }

        /* CSS */
.button-86 {
  all: unset;
  width: 100px;
  height: 30px;
  font-size: 16px;
  background: transparent;
  border: none;
  position: relative;
  color: #f0f0f0;
  cursor: pointer;
  z-index: 1;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-86::after,
.button-86::before {
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: -99999;
  transition: all .4s;
}

.button-86::before {
  transform: translate(0%, 0%);
  width: 100%;
  height: 100%;
  background: #28282d;
  border-radius: 10px;
}

.button-86::after {
  transform: translate(10px, 10px);
  width: 35px;
  height: 35px;
  background: #ffffff15;
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  border-radius: 50px;
}

.button-86:hover::before {
  transform: translate(5%, 20%);
  width: 110%;
  height: 110%;
}

.button-86:hover::after {
  border-radius: 10px;
  transform: translate(0, 0);
  width: 100%;
  height: 100%;
}

.button-86:active::after {
  transition: 0s;
  transform: translate(0, 5%);
}
        .outline-box {
            background-color: lightgrey;
            width: 500px;
            border: 1px solid black;
            padding: 100px;
            margin: 100px;
            margin-left: 400px;
        }
    </style>
</head>
<body>
<div class="outline-box">
<div class="form">
    <h2>E-mail Verification</h2>
        <input type="email" id="email" placeholder="Enter Email...">
          <div class="otpverify">
            <input type="text" id="otp_inp" placeholder="Enter the OTP sent to your Email...">
          <button class="btn" id="otp-btn">Verify</button>
        </div>
        <button onclick="sendOTP()"  class="button-86" role="button">Verify</button>
    </div>
</div>
    <script src="js/otp.js"></script>
</body>
</html>

