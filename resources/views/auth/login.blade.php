<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Login</h2>

                        @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Lembrar-me
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('register') }}" class="text-decoration-none small">Ainda não tem conta?</a>
                                <button type="submit" class="btn btn-primary px-4">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS para validação básica dos campos --}}
    <script>
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        function markInvalid(input, message) {
            input.classList.add('is-invalid');
            input.nextElementSibling.textContent = message;
        }

        function clearInvalid(input) {
            input.classList.remove('is-invalid');
            input.nextElementSibling.textContent = '';
        }

        loginForm.addEventListener('submit', (e) => {
            let valid = true;

            if (!emailInput.value.trim()) {
                markInvalid(emailInput, 'O e-mail é obrigatório.');
                valid = false;
            } else {
                clearInvalid(emailInput);
            }

            if (!passwordInput.value.trim()) {
                markInvalid(passwordInput, 'A senha é obrigatória.');
                valid = false;
            } else {
                clearInvalid(passwordInput);
            }

            if (!valid) e.preventDefault();
        });
    </script>
</x-guest-layout>