<x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Perfil</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                @error('name')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                @error('email')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nova senha (opcional)</label>
                <input id="password" type="password" name="password" class="form-control">
                <div class="invalid-feedback"></div>

                <ul id="password-rules" class="list-unstyled small mt-2 mb-4">
                    <li id="rule-length" class="text-danger">✗ Mínimo 8 caracteres</li>
                    <li id="rule-upper" class="text-danger">✗ Pelo menos 1 letra maiúscula</li>
                    <li id="rule-lower" class="text-danger">✗ Pelo menos 1 letra minúscula</li>
                    <li id="rule-number" class="text-danger">✗ Pelo menos 1 número</li>
                    <li id="rule-symbol" class="text-danger">✗ Pelo menos 1 símbolo (!, @, #, etc.)</li>
                </ul>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar nova senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
                <div class="invalid-feedback"></div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const form = document.getElementById('profileForm');

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

        passwordInput.addEventListener('input', function() {
            updatePasswordRules(passwordInput.value);
            clearInvalid(passwordInput);
        });

        confirmInput.addEventListener('input', function() {
            clearInvalid(confirmInput);
        });

        form.addEventListener('submit', function(e) {
            const pwd = passwordInput.value;
            const confirm = confirmInput.value;

            if (pwd) {
                const allPassed = Object.values(rules).every(rule => rule(pwd));
                if (!allPassed) {
                    e.preventDefault();
                    markInvalid(passwordInput, 'A senha não atende aos critérios de segurança.');
                }

                if (pwd !== confirm) {
                    e.preventDefault();
                    markInvalid(confirmInput, 'As senhas não coincidem.');
                }
            }
        });
    </script>
</x-app-layout>