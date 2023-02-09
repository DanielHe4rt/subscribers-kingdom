@extends('landing::layout.app')

@section('content')
    <section style="background-color: #eee;">

        <div class="container py-5">
            <x-alerts/>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ $user->avatar_url }}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ $user->username }}</h5>
                            <p class="text-muted mb-1"></p>

                            <div class="d-flex justify-content-center mb-2">
                                <i>{{ $currentSubscription ? $currentSubscription->getSubscriptionDescription() : 'Não inscrito (ainda)' }}</i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">Informações do Inscrito</div>
                        <div class="card-body">
                            <h3>Conexão com a Twitch</h3>
                            @if($twitchProvider)
                                <p>
                                    Você está conectado como <b>{{ $twitchProvider->provider_username }}</b> e sua
                                    conexão está
                                    desde <b>{{ $twitchProvider->created_at->format('d/m/Y H:i:s') }}.</b>
                                </p>
                                <button class="btn btn-primary">Desconectar Conta</button>
                            @endif
                            <hr>
                            @if($user->phone_verified_at)
                                <h3>Validar telefone</h3>
                                <p>
                                    Seu telefone foi verificado em
                                    <b>{{ $user->phone_verified_at->format('d/m/Y H:i:s') }}</b> e você
                                    {{ $currentSubscription ? 'está' : 'não está' }} elegível ao grupo de subs.
                                </p>
                                @if($currentSubscription)
                                    <a href="{{ '#' }}">Link para grupo de subs</a>
                                @endif
                            @else
                                <h3>Validar telefone</h3>
                                @if(cache()->tags(['awaiting-validation'])->has($user->id))
                                    <p>Se você quiser fazer parte do grupo do zap isso aqui é bem necessário :p</p>
                                    <form action="{{ route('subscribers.verify') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input id="code" type="text" class="form-control"
                                                       placeholder="abc12"
                                                       name="code" max="5"
                                                >
                                                <button class="btn btn-primary" type="submit">
                                                    Verificar Código
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                @else
                                    <p>Se você quiser fazer parte do grupo do zap isso aqui é bem necessário :p</p>
                                    <form action="{{ route('subscribers.send-code') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">+55</span>
                                                <input type="tel" class="form-control"
                                                       placeholder="11400289222" name="phone_number"
                                                       value="{{ old('phone_number') }}"
                                                >
                                                <button class="btn btn-primary" type="submit">
                                                    Enviar Código
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                @endif
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
