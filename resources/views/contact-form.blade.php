@extends('layouts.main')

@section('styles')
@endsection

@section('content')
    <div id="page">
        <contact-form-component></contact-form-component>
    </div>
@endsection

@section('scripts')
<script>
    (function ($) {
        "use strict";
        $('.js-tilt').tilt({
            scale: 1.1
        })
    })(jQuery)
</script>
@endsection
