@extends("adminpanel.layouts.main")

@section("title", $title)

@section("content")

    <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @if (count($charts) > 0)
            <div class="row text-center">
                @foreach ($charts as $item)
                    @if ($item['status'])
                        <div class="{{ $item['class'] }}">
                            <div class="kt-portlet kt-portlet--height-fluid text-center">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title"> {{ $item['title'] }} </h3>
                                    </div>
                                    <div class="kt-widget14__content row">
                                        <div class="kt-widget14__chart col" style="width: 100%">
                                            <div id="{{ $item['id'] }}" style="height: 250px; width: 100%; margin: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        @if (count($cruds) > 0)
            <div class="row">
                @foreach ($cruds as $item)
                    @if ($item["status"])
                        <div class="col-12">
                            @include($item["table"]["name"], $item["table"]["data"])
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section("js_scripts")
    @if (count($cruds) > 0)
        @foreach ($cruds as $item)
            @if ($item["status"])
                @foreach ($item["modals"]["name"] as $modal)
                    @include($modal, $item["modals"]["data"])
                @endforeach
            @endif
        @endforeach
    @endif
    @if (count($charts) > 0)
        @foreach ($charts as $item)
            @if ($item["status"])
                <script>
                    drawAmChartsPie('{{ $item["id"] }}', @json($item['results']) );
                </script>
            @endif
        @endforeach
    @endif
@endsection
