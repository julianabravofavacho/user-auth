<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                @if(session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
                @endif

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Editar Perfil</h3>

                        <form method="POST" action="{{ route('profile.update') }}" id="profileForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex justify-content-center mb-4">
                                <x-profile-avatar
                                    :name="Auth::user()->name"
                                    :image="Auth::user()->profile_image"
                                    inputName="profile_image" />
                            </div>

                            {{-- Nome --}}
                            <div class="mb-3">
                                <label class="form-label">Nome completo</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            {{-- E-mail --}}
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            {{-- Senha --}}
                            <div class="mb-3">
                                <label class="form-label">Nova senha (opcional)</label>
                                <input id="password" type="password" name="password" class="form-control">
                                <div class="invalid-feedback"></div>

                                <ul id="password-rules" class="list-unstyled small mt-2 mb-0">
                                    <li id="rule-length" class="text-danger">✗ Mínimo 8 caracteres</li>
                                    <li id="rule-upper" class="text-danger">✗ Pelo menos 1 letra maiúscula</li>
                                    <li id="rule-lower" class="text-danger">✗ Pelo menos 1 letra minúscula</li>
                                    <li id="rule-number" class="text-danger">✗ Pelo menos 1 número</li>
                                    <li id="rule-symbol" class="text-danger">✗ Pelo menos 1 símbolo (!, @, #, etc.)</li>
                                </ul>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript de Validação ao Digitar --}}
    <script>
        const form = document.getElementById('profileForm');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        // Regras de senha
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

        // Validação ao digitar nos campos de texto
        nameInput.addEventListener('input', () => {
            if (nameInput.value.trim().length < 2) {
                markInvalid(nameInput, 'O nome deve ter pelo menos 2 caracteres.');
            } else {
                clearInvalid(nameInput);
            }
        });

        emailInput.addEventListener('input', () => {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                markInvalid(emailInput, 'Digite um e-mail válido.');
            } else {
                clearInvalid(emailInput);
            }
        });

        passwordInput.addEventListener('input', () => {
            updatePasswordRules(passwordInput.value);
            clearInvalid(passwordInput);
        });

        form.addEventListener('submit', (e) => {
            let valid = true;

            if (nameInput.value.trim().length < 2) {
                markInvalid(nameInput, 'O nome deve ter pelo menos 2 caracteres.');
                valid = false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                markInvalid(emailInput, 'Digite um e-mail válido.');
                valid = false;
            }

            const pwd = passwordInput.value;
            if (pwd && !Object.values(rules).every(rule => rule(pwd))) {
                markInvalid(passwordInput, 'A senha não atende aos critérios de segurança.');
                valid = false;
            }

            if (!valid) e.preventDefault();
        });
    </script>
</x-app-layout>