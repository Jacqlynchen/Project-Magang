<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Avian Brands</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

</head>

<body>

<div class="login-page">

    <div class="login-card">

        {{-- LOGO --}}
        <div class="login-logo">

            <img
                src="{{ asset('images/avian-logo.png') }}"
                alt="Avian Brands"
            >

        </div>


        {{-- TITLE --}}
        <h1 class="login-title">
            Selamat datang!
        </h1>

        <p class="login-description">
            Silahkan isi email dan password di bawah ini untuk login.
        </p>


        {{-- FORM --}}
        <form
            method="POST"
            action="{{ route('login') }}"
        >

            @csrf


            {{-- EMAIL --}}
            <div class="login-form-group">

                <label for="email">
                    E-mail <span class="login-required">*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="login-input"
                    placeholder="Masukan email.."
                    required
                    autofocus
                >

                @error('email')
                    <div class="login-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- PASSWORD --}}
            <div class="login-form-group">

                <label for="password">
                    Password <span class="login-required">*</span>
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="login-input"
                    placeholder="............"
                    required
                >

                @error('password')
                    <div class="login-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- LOGIN --}}
            <button type="submit" class="login-button">
                Login
            </button>

        </form>

    </div>

</div>

</body>

</html>