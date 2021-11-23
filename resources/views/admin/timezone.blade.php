@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                @if ($timezones->count())
                <div class="form-group">
                    <label for="">Timezone</label>
                    <select class="form-control changeTimezone">
                        @foreach ($timezones as $timezone)
                            <option value="{{$timezone->name}}" {{$timezone->name == Auth::user()->timezone ? 'selected' : ''}}>{{$timezone->time}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        var url = "{{route('timezone.setUserTimeZone')}}"
        $('.changeTimezone').change(function() {
            window.location.href = url + "?timezone="+$(this).val();
        })
    </script>
@endpush
