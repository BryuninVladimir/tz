
@extends('layouts.app')

@section('content')

    <div class="chars-list">

        @if ($chars && count($chars) > 0)

            <div class="panel-body">
                <table class="table table-striped">

                    <thead>
                        <th>Character</th>
                    </thead>

                    <tbody>
                    @foreach ($chars as $char)
                        <tr>
                           <td class="table-text">
                                <a href="{{ url('char/detail', $char->id) }}">{{ $char->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h4>There is not characters yet</h4>
        @endif
    </div>

@endsection
