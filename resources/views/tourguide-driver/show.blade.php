@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tourguide Driver/</span> {{ $record->name }}</h4>
        <!-- Striped Rows -->
        <div class="card">
            <h5 class="card-header">Tourguide Driver Table</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="7">
                                <h5>ACCUMULATED % share of Tourguide and Drivers and individual
                                    bringing guests in Binuatan Creations</h5>
                            </th>
                        </tr>
                        <tr class="text-left">
                            <th colspan="4">Name: {{ $record->name }}</th>
                            <th colspan="3">Occupation: {{ $record->occupation }}</th>
                        </tr>

                        <tr>
                            <th class="text-left">Date</th>
                            <th class="text-left">Names of Guide & Drivers</th>
                            <th class="text-left">Name of Agency</th>
                            <th class="text-right">Total Sale</th>
                            <th class="text-right">6% share</th>
                            <th class="text-right">Share</th>
                            <th class="text-left">{{ $record->name }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $totalAmount = 0;
                        @endphp
                        @forelse ($record->logBooks->sortBy('created_at') as $item)
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
                                <td class="text-right">{{ number_format($item->logBook->individual_share, 2) }}
                                    <a href="{{ route('log-book.edit', ['id' => $item->logBook->id]) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
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
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>
@endsection
