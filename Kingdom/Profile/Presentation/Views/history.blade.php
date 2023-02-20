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
                            <h5 class="my-3">{{ $user->username  . ' - ' . $user->monthsSubscribed}}</h5>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Plataforma</td>
                                        <td>Data</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->provider }}</td>
                                        <td>{{ $subscription->subscribed_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
