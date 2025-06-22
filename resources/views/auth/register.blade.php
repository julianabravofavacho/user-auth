<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Cadastro de Usuário</h2>

                        @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                            @csrf

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="name" class="form-label">Nome completo</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Senha</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar senha</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <ul id="password-rules" class="list-unstyled small text-muted mb-4">
                                <li id="rule-length" class="text-danger">✗ Mínimo 8 caracteres</li>
                                <li id="rule-upper" class="text-danger">✗ Pelo menos 1 letra maiúscula</li>
                                <li id="rule-lower" class="text-danger">✗ Pelo menos 1 letra minúscula</li>
                                <li id="rule-number" class="text-danger">✗ Pelo menos 1 número</li>
                                <li id="rule-symbol" class="text-danger">✗ Pelo menos 1 símbolo (!, @, #, etc.)</li>
                            </ul>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}" class="text-decoration-none small">Já tem conta? Faça login</a>
                                <button type="submit" class="btn btn-success px-4">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS de validação --}}
    <script>
        const userName = document.getElementById('name');
        const userEmail = document.getElementById('email');
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
            const vName = userName.value;
            const vEmail = userEmail.value;
            const pwd = passwordInput.value;
            const confirm = confirmInput.value;

            // Verificação de nome
            if (!vName.trim()) {
                markInvalid(userName, 'O nome é obrigatório.');
                valid = false;
            } else {
                clearInvalid(userName);
            }

            // Verificação de e-mail
            if (!vEmail.trim()) {
                markInvalid(userEmail, 'O e-mail é obrigatório.');
                valid = false;
            } else {
                clearInvalid(userEmail);
            }

            // Validação da senha
            if (!Object.values(rules).every(rule => rule(pwd))) {
                markInvalid(passwordInput, 'A senha não atende aos critérios de segurança.');
                valid = false;
            } else {
                clearInvalid(passwordInput);
            }

            // Confirmação de senha
            if (pwd !== confirm) {
                markInvalid(confirmInput, 'As senhas não coincidem.');
                valid = false;
            } else {
                clearInvalid(confirmInput);
            }

            if (!valid) e.preventDefault();
        });
    </script>
</x-guest-layout>