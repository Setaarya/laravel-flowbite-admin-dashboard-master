<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .alert {
            padding: 10px;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: -5px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Pengaturan Pengguna</h2>

        <!-- Alert success message -->
        <div class="alert" id="successMessage" style="display: none;">
            Data berhasil diperbarui.
        </div>

        <form id="userSettingsForm">
            <div>
                <label for="name">Nama</label>
                <input type="text" id="name" placeholder="Masukkan nama" required>
                <p class="error" id="nameError"></p>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Masukkan email" required>
                <p class="error" id="emailError"></p>
            </div>

            <div>
                <label for="password">Password (Opsional)</label>
                <input type="password" id="password" placeholder="Masukkan password baru">
                <p class="error" id="passwordError"></p>
            </div>

            <div>
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" placeholder="Ulangi password">
            </div>

            <button type="submit">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('userSettingsForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Ambil nilai input
            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var password = document.getElementById('password').value.trim();
            var password_confirmation = document.getElementById('password_confirmation').value.trim();

            // Reset error messages
            document.getElementById('nameError').textContent = "";
            document.getElementById('emailError').textContent = "";
            document.getElementById('passwordError').textContent = "";

            var isValid = true;

            // Validasi nama
            if (name === "") {
                document.getElementById('nameError').textContent = "Nama wajib diisi.";
                isValid = false;
            }

            // Validasi email
            if (email === "") {
                document.getElementById('emailError').textContent = "Email wajib diisi.";
                isValid = false;
            } else if (!email.includes("@")) {
                document.getElementById('emailError').textContent = "Format email tidak valid.";
                isValid = false;
            }

            // Validasi password
            if (password !== "" && password.length < 6) {
                document.getElementById('passwordError').textContent = "Password minimal 6 karakter.";
                isValid = false;
            }

            // Validasi konfirmasi password
            if (password !== "" && password !== password_confirmation) {
                document.getElementById('passwordError').textContent = "Konfirmasi password tidak sesuai.";
                isValid = false;
            }

            if (isValid) {
                document.getElementById('successMessage').style.display = "block";

                // Simulasi submit form (seharusnya dikirim ke backend di aplikasi nyata)
                setTimeout(() => {
                    document.getElementById('successMessage').style.display = "none";
                }, 3000);
            }
        });
    </script>

</body>
</html>
