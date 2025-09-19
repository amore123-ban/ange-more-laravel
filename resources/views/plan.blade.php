<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos plans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center">Nos plans d'abonnement</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($plans as $plan)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $plan->name }}</h5>
                        <p class="card-text">{{ $plan->description ?? 'Pas de description' }}</p>
                        <h6 class="mb-3">
                            {{ number_format($plan->price, 0, ',', ' ') }} {{ $plan->currency }}
                        </h6>

                        <div class="mt-auto">
                            <!-- Essai gratuit -->
                            <form method="POST" action="{{ route('subscribe', $plan->id) }}">
                                @csrf
                                <button class="btn btn-outline-primary w-100 mb-2">
                                    Essai gratuit 14 jours
                                </button>
                            </form>

                            <!-- Payer maintenant -->
                            <form method="POST" action="{{ route('pay', $plan->id) }}">
                                @csrf
                                <button class="btn btn-primary w-100">
                                    Payer maintenant
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Aucun plan disponible pour le moment.</p>
        @endforelse
    </div>
</div>
</body>
</html>
