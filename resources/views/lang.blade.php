@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="">{{ Auth::user()->lang == 'en' ? 'Language' : 'Bahasa' }}</label>
                    <select class="form-control changeLang">
                        <option value="en" {{ Auth::user()->lang == 'en' ? 'selected' : '' }}>English</option>
                        <option value="in" {{ Auth::user()->lang == 'in' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        var url = "{{route('lang.changeLang')}}"
        $('.changeLang').change(function() {
            window.location.href = url + "?lang="+$(this).val();
        })
    </script>
@endpush
