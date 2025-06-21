<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Cadastro de Usuário</h2>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback"></div>

                                <ul id="password-rules" class="list-unstyled small mt-2 mb-4">
                                    <li id="rule-length" class="text-danger">✗ Mínimo 8 caracteres</li>
                                    <li id="rule-upper" class="text-danger">✗ Pelo menos 1 letra maiúscula</li>
                                    <li id="rule-lower" class="text-danger">✗ Pelo menos 1 letra minúscula</li>
                                    <li id="rule-number" class="text-danger">✗ Pelo menos 1 número</li>
                                    <li id="rule-symbol" class="text-danger">✗ Pelo menos 1 símbolo (!, @, #, etc.)</li>
                                </ul>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4">Cadastrar</button>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('login') }}">Já tem conta? Faça login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script de validação --}}
    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const form = document.getElementById('registerForm');

        const rules = {
            length: pwd => pwd.length >= 8,
            upper: pwd => /[A-Z]/.test(pwd),
            lower: pwd => /[a-z]/.test(pwd),
            number: pwd => /[0-9]/.test(pwd),
            symbol: pwd => /[^a-zA-Z0-9]/.test(pwd),
        };

        const feedbackList = {
            length: document.getElementById('rule-length'),
            upper: document.getElementById('rule-upper'),
            lower: document.getElementById('rule-lower'),
            number: document.getElementById('rule-number'),
            symbol: document.getElementById('rule-symbol'),
        };

        function updatePasswordRules(pwd) {
            for (const key in rules) {
                const passed = rules[key](pwd);
                feedbackList[key].textContent = (passed ? '✓' : '✗') + ' ' + feedbackList[key].textContent.slice(2);
                feedbackList[key].classList.toggle('text-success', passed);
                feedbackList[key].classList.toggle('text-danger', !passed);
            }
        }

        function markInvalid(input, message) {
            input.classList.add('is-invalid');
            input.nextElementSibling.textContent = message;
        }

        function clearInvalid(input) {
            input.classList.remove('is-invalid');
            input.nextElementSibling.textContent = '';
        }

        passwordInput.addEventListener('input', () => {
            updatePasswordRules(passwordInput.value);
            clearInvalid(passwordInput);
        });

        confirmInput.addEventListener('input', () => {
            clearInvalid(confirmInput);
        });

        form.addEventListener('submit', (e) => {
            let valid = true;
            const pwd = passwordInput.value;
            const confirm = confirmInput.value;

            if (!Object.values(rules).every(rule => rule(pwd))) {
                markInvalid(passwordInput, 'A senha não atende aos critérios de segurança.');
                valid = false;
            }

            if (pwd !== confirm) {
                markInvalid(confirmInput, 'As senhas não coincidem.');
                valid = false;
            }

            if (!valid) e.preventDefault();
        });
    </script>
</x-guest-layout>