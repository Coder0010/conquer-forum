
@foreach (["info", "success", "warning", "danger", "status"] as $item)
    @if ($message = Session::get($item))
        <div class="alert alert-custom alert-light-{{ $item == 'status' ? 'success' : $item }}" role="alert" id="kt_form_1_msg">
            <div class="alert-icon">
                <i class="flaticon2-information"></i>
            </div>
            <div class="alert-text font-weight-bold">
                {{ $message }}
            </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span> <i class="ki ki-close"></i> </span>
                </button>
            </div>
        </div>
    @endif
@endforeach

@if ($errors->any())
    <div class="alert alert-custom alert-light-primary" role="alert" id="kt_form_1_msg">
        <div class="alert-icon">
            <i class="flaticon2-information"></i>
        </div>
        <div class="alert-text font-weight-bold">
            <ul>
                <li>
                    <span> Please check the form below for errors </span>
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li> {{ $item }} </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
@endif
