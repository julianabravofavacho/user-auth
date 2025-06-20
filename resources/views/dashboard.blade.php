<x-app-layout>
    <div class="container mt-5">
        <div class="alert alert-success">
            Você está logado!
        </div>

        <div class="card">
            <div class="card-header">
                Dashboard
            </div>
            <div class="card-body">
                <p class="card-text">Bem-vindo(a), {{ Auth::user()->name }}!</p>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    Editar perfil
                </a>
            </div>
        </div>
    </div>
</x-app-layout>