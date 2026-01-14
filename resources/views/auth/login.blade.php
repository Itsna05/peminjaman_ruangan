<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS Login --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="login-wrapper">
    <div class="card login-card shadow">
        <div class="card-body text-center">

            {{-- Logo (sudah termasuk tulisan) --}}
            <img src="{{ asset('img/logo_login.png') }}"
                 alt="Logo DPU"
                 class="login-logo mb-4">

            {{-- Form --}}
            <form action="#" method="POST">
                @csrf

                <div class="mb-3">
                    <input type="text"
                           class="form-control"
                           placeholder="Masukkan Username"
                           required>
                </div>

                <div class="mb-4">
                    <input type="password"
                           class="form-control"
                           placeholder="Masukkan Password"
                           required>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-semibold">
                    MASUK
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
