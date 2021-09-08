@extends('layouts.app')

@section('content')
    <div class="container table-container">
        <h2 class="py-4">Messages</h2>
        <table class="table tables-custom">
            <thead>
                <tr>
                    <th class="lead">Name</th>
                    <th class="lead">Email</th>
                    <th class="lead">Messages</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td class="lead">{{ $message->name }}</td>
                        <td class="lead">{{ $message->email }}</td>
                        <td class="lead">{{ $message->message }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>There are no messages!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
