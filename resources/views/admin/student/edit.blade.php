@extends('layouts.app')

@section('content')
<h1>Edit Student</h1>

<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf
    @method('PUT')
    <label>First Name:</label>
    <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}">
    <br>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}">
    <br>
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $student->email) }}">
    <br>
    <!-- Add other fields similarly -->
    <button type="submit">Update</button>
</form>
@endsection
