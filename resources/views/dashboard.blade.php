<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-white border-0 text-center pt-4">
                        <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                alt="Foto de Perfil"
                                class="img-fluid rounded-circle border border-secondary w-100 h-100 object-fit-cover">
                        </div>
                        <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="card-body text-center">
                        <p class="lead mb-4">Bem-vindo(a) à sua área de usuário.</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary px-4">Editar perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>