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
                <td><b>{{ number_format($item->amount, 2) }}</b></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"></td>
            <td><b>{{ number_format($data->sum('amount'), 2) }}</b></td>
        </tr>
    </tbody>
</table>
