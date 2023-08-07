@extends('emails.layout')

@section('content')
    {{-- @include('emails.partials.header') --}}
    <tbody>
        <tr>
            <td style="height:35px;"></td>
        </tr>
        <tr>
            <td style="font-size:20px; font-weight:800; text-align:center"> Question </td>
        </tr>
        <tr>
            <td style="height:10px;"></td>
        </tr>
        <tr>
            <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                <p style="font-size:14px;margin:0 0 10px 0;">
                <h4> {{ $name }} </h4>
                <h4> {{ $email }} </h4>
                <h2 style="font-weight:normal;margin:0">
                    {{ $question }}
                </h2>
                </p>
            </td>
        </tr>
        <tr>
            <td style="height:35px;"></td>
        </tr>
    </tbody>

    {{-- @include('mail.partials.table_footer') --}}
@endsection
