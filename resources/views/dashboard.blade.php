<x-app-layout>
    <div class="container mt-5">
        <div class="alert alert-success">
            Você está logado!
        </div>

        <div class="card">
            <div class="card-header">
                Dashboard
            </div>

            <!--<div class="card-body">
                <img style="height:auto;" src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="Foto de perfil"
                    class="rounded-circle"
                    width="260" height="260">

                <p class="card-text">Bem-vindo(a), {{ Auth::user()->name }}!</p>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    Editar perfil
                </a>
            </div>-->
            <div class="position-relative d-inline-block rounded-circle overflow-hidden" style="width: 150px; height: 150px;">
                <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="Foto de Perfil"
                    class="img-fluid rounded-circle border border-secondary w-100 h-100 object-fit-cover">
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