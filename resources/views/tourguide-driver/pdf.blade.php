<style>
    @page {
        margin: 8px;
    }

    body {
        margin: 0px;
    }

    table,
    td,
    th {
        border: 1px solid rgb(172, 168, 168);
        font-family: Arial;
        font-size: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        color: rgb(61, 56, 56);
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .hr-dash {
        border-top: 1px dotted black;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        margin-left: 2px;
        float: left;
        width: 50%;
        */
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
@forelse ($records as $record)

    <div class="row">
        <div class="column">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" colspan="7">ACCUMULATED % share of Tourguide and Drivers and
                            individual
                            bringing guests in Binuatan Creations</th>
                    </tr>
                    <tr>
                        <th class="text-left" colspan="4">Name: {{ $record->name }}</th>
                        <th class="text-left" colspan="3">Occupation: {{ $record->occupation }}</th>
                    </tr>

                    <tr>
                        <th width="12%" class="text-left">Date</th>
                        <th width="20%" class="text-left">Names of Guide & Drivers</th>
                        <th width="15%" class="text-left">Name of Agency</th>
                        <th width="10%" class="text-right">Total Sale</th>
                        <th width="10%" class="text-right">6% share</th>
                        <th width="10%" class="text-right">Share</th>
                        <th width="10%" class="text-left">{{ $record->name }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                        $totalAmount = 0;
                    @endphp
                    @forelse ($record->logBooks as $item)
                        @php
                            $totalAmount += $item->logBook->individual_share;
                        @endphp
                        <tr>
                            <td>{{ $item->logBook->date }}</td>
                            <td>
                                @foreach ($item->logBook->touguideDrivers as $item)
                                    {{ $item->profile->name }}
                                    <br>
                                @endforeach
                            </td>
                            <td>{{ $item->logBook->agency }}</td>
                            <td class="text-right">{{ number_format($item->logBook->amount, 2) }}</td>
                            <td class="text-right">{{ number_format($item->logBook->share, 2) }}</td>
                            <td class="text-right">{{ number_format($item->logBook->individual_share, 2) }}</td>
                            <td class="text-right">{{ number_format($item->logBook->individual_share, 2) }}</td>
                        </tr>
                    @empty
                    @endforelse
                    <tr>
                        <td colspan="5">Merry Christmas {{ $record->name }}!</td>
                        <td class="text-right"><b>Total</b></td>
                        <td class="text-right"><b>{{ number_format($totalAmount, 2) }}</b></td>
                    </tr>
                </tbody>
            </table>
            <hr class="hr-dash">
        </div>
        <div class="column">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" colspan="7">ACCUMULATED % share of Tourguide and Drivers and
                            individual
                            bringing guests in Binuatan Creations</th>
                    </tr>
                    <tr>
                        <th class="text-left" colspan="4">Name: {{ $record->name }}</th>
                        <th class="text-left" colspan="3">Occupation: {{ $record->occupation }}</th>
                    </tr>
                    <tr>
                        <th width="12%" class="text-left">Date</th>
                        <th width="20%" class="text-left">Names of Guide & Drivers</th>
                        <th width="15%" class="text-left">Name of Agency</th>
                        <th width="10%" class="text-right">Total Sale</th>
                        <th width="10%" class="text-right">6% share</th>
                        <th width="10%" class="text-right">Share</th>
                        <th width="10%" class="text-left">{{ $record->name }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                        $totalAmount = 0;
                    @endphp
                    @forelse ($record->logBooks as $item)
                        @php
                            $totalAmount += $item->logBook->individual_share;
                        @endphp
                        <tr>
                            <td>{{ $item->logBook->date }}</td>
                            <td>
                                @foreach ($item->logBook->touguideDrivers as $item)
                                    {{ $item->profile->name }}
                                    <br>
                                @endforeach
                            </td>
                            <td>{{ $item->logBook->agency }}</td>
                            <td class="text-right">{{ $item->logBook->amount }}</td>
                            <td class="text-right">{{ $item->logBook->share }}</td>
                            <td class="text-right">{{ $item->logBook->individual_share }}</td>
                            <td class="text-right">{{ $item->logBook->individual_share }}</td>
                        </tr>
                    @empty
                    @endforelse
                    <tr>
                        <td colspan="5">Merry Christmas {{ $record->name }}!</td>
                        <td class="text-right"><b>Total</b></td>
                        <td class="text-right"><b>{{ $totalAmount }}</b></td>
                    </tr>
                </tbody>
            </table>
            <hr class="hr-dash">
        </div>
    </div>

@empty
@endforelse
