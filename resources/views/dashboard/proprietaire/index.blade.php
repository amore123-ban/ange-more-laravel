<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Action réelle</th>
            <th>Action prédite</th>
            <th>Détails du produit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->user_id }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->predicted_action ?? 'N/A' }}</td>
                <td>
                    @if(isset($log->details_array['name']))
                        Nom: {{ $log->details_array['name'] }} <br>
                        Prix: {{ $log->details_array['price'] }} <br>
                        Quantité: {{ $log->details_array['quantity'] }} <br>
                        Catégorie: {{ $log->details_array['category_id'] }} <br>
                        Boutique: {{ $log->details_array['shop_id'] }}
                    @else
                        N/A
                    @endif
                    <br>
                    <a href="{{ url('activities/'.$log->id) }}">Voir plus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
