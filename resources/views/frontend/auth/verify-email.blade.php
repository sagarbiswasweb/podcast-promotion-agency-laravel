<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .verify-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h4 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #333;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }

        .btn {
            padding: 10px 20px;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        #countdown {
            margin-top: 10px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="verify-container">
        <h4>Verify Your Email</h4>

        <div id="message-area">
            @if(session('message'))
                <div class="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <p>Didn't get the email?</p>

        <form id="resend-form">
            <button type="submit" class="btn" id="resend-btn">Resend Verification Email</button>
            <div id="countdown"></div>
        </form>
    </div>

    <script>
        const resendForm = document.getElementById('resend-form');
        const resendBtn = document.getElementById('resend-btn');
        const countdownEl = document.getElementById('countdown');
        const messageArea = document.getElementById('message-area');

        let timer = null;
        let waitTime = 60; // seconds

        resendForm.addEventListener('submit', function(e) {
            e.preventDefault();

            resendBtn.disabled = true;
            countdownEl.textContent = "Sending...";
            messageArea.innerHTML = ""; // Clear previous messages

            fetch("{{ route('verification.send') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
            }).then(response => {
                if (response.ok) {
                    startCountdown(waitTime);
                    showMessage("Verification email sent successfully!", "success");
                } else if (response.status === 429) {
                    startCountdown(waitTime);
                    showMessage("Too many attempts. Please wait before retrying.", "error");
                } else {
                    showMessage("Something went wrong. Please try again later.", "error");
                    resendBtn.disabled = false;
                    countdownEl.textContent = "";
                }
            }).catch(error => {
                showMessage("Error occurred. Please try again.", "error");
                resendBtn.disabled = false;
                countdownEl.textContent = "";
            });
        });

        function startCountdown(seconds) {
            let remaining = seconds;
            countdownEl.textContent = `Please wait ${remaining}s`;

            timer = setInterval(() => {
                remaining--;
                if (remaining > 0) {
                    countdownEl.textContent = `Please wait ${remaining}s`;
                } else {
                    clearInterval(timer);
                    resendBtn.disabled = false;
                    countdownEl.textContent = "";
                }
            }, 1000);
        }

        function showMessage(message, type) {
            const div = document.createElement('div');
            div.className = type === "success" ? "alert" : "error";
            div.textContent = message;
            messageArea.innerHTML = ""; // Clear previous
            messageArea.appendChild(div);
        }
    </script>

</body>
</html>
