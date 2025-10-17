<h3>Log #{{ $activity->id }}</h3>
<p><strong>User:</strong> {{ $activity->user_id }}</p>
<p><strong>Action:</strong> {{ $activity->action }}</p>
<p><strong>URL:</strong> {{ $activity->url }}</p>
<p><strong>Method:</strong> {{ $activity->method }}</p>
<p><strong>IP:</strong> {{ $activity->ip_address }}</p>
<p><strong>Détails:</strong> {{ $activity->details }}</p>
<p><strong>Prédiction IA:</strong> {{ $activity->predicted_action ?? 'N/A' }}</p>
<a href="{{ url('activities') }}">Retour</a>
