@extends('Dashboard.layouts.master')

@section('title')
    Edit Governorate
@endsection


@section('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            margin: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            margin: 30px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 5px;
            width: 300px;
        }

        .submit-btn {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin: 30px;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
@stop

@section('content')

    <h1>Edit Governorate</h1>
    <form action="{{ route('updateGroup', ['groupId' => $group->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Governorate Name:</label>
            <input type="text" id="name" name="name" value="{{ $group->name }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="submit-btn">Update Governorate</button>
    </form>

@endsection

@section('scripts')

@stop
