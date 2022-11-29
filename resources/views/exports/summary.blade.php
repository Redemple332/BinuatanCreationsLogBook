<table>
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Occupation</b></th>
            <th><b>Agency</b></th>
            <th><b>Amount</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->occupation }}</td>
                <td>{{ $item->agency }}</td>
                @php
                    $totalAmount = 0;
                @endphp
                @forelse ($item->logBooks as $item2)
                    @php
                        $totalAmount += $item2->logBook->individual_share;
                    @endphp
                @empty
                @endforelse
                <td><b>{{ number_format($totalAmount, 2) }}</b></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"></td>
            <td><b>{{ number_format($data->sum('amount'), 2) }}</b></td>
        </tr>
    </tbody>
</table>
