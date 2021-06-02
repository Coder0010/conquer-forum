@if ($message = Session::get("info"))
    <div class="alert alert-info fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <strong>{{ __("main.info") }}</strong> {{ $message }}
    </div>
@endif

@if ($message = Session::get("success"))
    <div class="alert alert-success fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <i class="fa fa-check mx-2"></i>
        <strong>{{ __("main.success") }}</strong> {{ $message }}
    </div>
@endif

@if ($message = Session::get("warning"))
    <div class="text-black alert alert-warning fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <i class="fa fa-info mx-2"></i>
        <strong>{{ __("main.warning") }}</strong> {{ $message }}
    </div>
@endif

@if ($message = Session::get("danger"))
    <div class="alert alert-danger fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <strong>{{ __("main.danger") }}</strong> {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-info fade show mb-1" role="alert">
        <ul class="list-unstyled">
            <li>Please check the form below for errors</li>
            @foreach ($errors->all() as $item) <li> {{ $item }} </li> @endforeach
        </ul>
    </div>
@endif
