@extends('tienda.layout')

@section('title', 'Iniciar Sesión - Bajo Cero')

@section('styles')
<style>
    .login-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
        background: var(--bg-main);
    }

    .login-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: 0;
        padding: 2.5rem;
        box-shadow: var(--glow);
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--accent-neon);
        box-shadow: var(--glow);
    }

    .login-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--text-main);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-floating > label {
        color: var(--text-muted);
    }

    .form-control:focus ~ label {
        color: var(--accent-neon);
    }

    .btn-login {
        background: transparent;
        border: 2px solid var(--accent-neon);
        color: var(--accent-neon);
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.8rem;
        width: 100%;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .btn-login:hover {
        background: var(--accent-neon);
        color: var(--bg-main);
        box-shadow: var(--glow-hover);
    }
</style>
@endsection

@section('content')
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card">
                    <h3 class="login-title">Acceso al Sistema</h3>
                    
                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                        <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-4" role="alert" style="background: rgba(220, 53, 69, 0.1); border: 1px solid #dc3545; color: #dc3545;">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $item }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach
                    @endif

                    <form action="{{ route('login.login') }}" method="post">
                        @csrf
                        <div class="form-floating mb-4">
                            <input autofocus autocomplete="off" value="invitado@gmail.com" class="form-control bg-transparent text-white" name="email" id="inputEmail" type="email" placeholder="name@example.com" style="border-color: var(--border-color); color: var(--text-main) !important;" />
                            <label for="inputEmail">Correo Electrónico</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input class="form-control bg-transparent text-white" name="password" value="12345678" id="inputPassword" type="password" placeholder="Password" style="border-color: var(--border-color); color: var(--text-main) !important;" />
                            <label for="inputPassword">Contraseña</label>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-login" type="submit">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection