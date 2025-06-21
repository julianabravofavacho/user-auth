<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">

                        <h4 class="card-title mb-4 text-center">Editar Perfil</h4>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" id="profileForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex justify-content-center mb-4">
                                <x-profile-avatar
                                    :name="Auth::user()->name"
                                    :image="Auth::user()->profile_image"
                                    inputName="profile_image" />
                            </div>

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

                                <ul id="password-rules" class="list-unstyled small mt-2 mb-0">
                                    <li id="rule-length" class="text-danger">✗ Mínimo 8 caracteres</li>
                                    <li id="rule-upper" class="text-danger">✗ Pelo menos 1 letra maiúscula</li>
                                    <li id="rule-lower" class="text-danger">✗ Pelo menos 1 letra minúscula</li>
                                    <li id="rule-number" class="text-danger">✗ Pelo menos 1 número</li>
                                    <li id="rule-symbol" class="text-danger">✗ Pelo menos 1 símbolo (!, @, #, etc.)</li>
                                </ul>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
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

        form.addEventListener('submit', function(e) {
            const pwd = passwordInput.value;

            if (pwd) {
                const allPassed = Object.values(rules).every(rule => rule(pwd));
                if (!allPassed) {
                    e.preventDefault();
                    markInvalid(passwordInput, 'A senha não atende aos critérios de segurança.');
                }
            }
        });
    </script>
</x-app-layout>