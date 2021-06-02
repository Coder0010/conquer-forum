<!--begin::Footer-->
<div id="kt_footer" class="footer bg-white py-4 d-flex flex-lg-column">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">{{ date("Y") }} &nbsp; &copy; &nbsp; </span>
            <span class="text-success font-weight-bolder text-capitalize">{{ config("system.version") }}</span>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark">
            <a href="{{ config("system.developer.url") }}" target="_blank" class="nav-link pl-0 pr-5">{{ config("system.developer.name") }}</a>
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
