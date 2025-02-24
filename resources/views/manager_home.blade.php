@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <div>
        <h2>Low Stock Items</h2>
        <ul>
            @foreach ($data['low_stock'] as $item)
                <li>{{ $item->name }}:swirling blue lines and dots dance against a dark background. the lines form intricate patterns, almost like a web of light. the dots are small and scattered, creating a sparkling, ethereal effect. the overall impression is one of fluidity and motion, as if the lines are dancing across the screen. the image evokes a sense of mystery and wonder, as if one is looking at a cosmic landscape. it is a mesmerizing display of light and color. items remaining</li>
            @endforeach
        </ul>
    </div>

    <div>
        <h2>Items In Today</h2>
        <ul>
            @foreach ($data['in_today'] as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ul>
    </div>

    <div>
        <h2>Items Out Today</h2>
        <ul>
            @foreach ($data['out_today'] as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ul>
        </div>
@endsection
