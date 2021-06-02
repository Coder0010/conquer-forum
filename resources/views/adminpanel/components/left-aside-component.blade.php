<!--begin::Aside-->
<div id="kt_aside" class="aside aside-left aside-fixed d-flex flex-column flex-row-auto">
    <!--begin::Brand-->
    <div id="kt_brand" class="brand flex-column-auto">
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}" class="brand-logo text-center">
            <img src='{{ GetSettingMediaUrl("logo_".GetLanguage()) }}' alt='{{ GetSettingTransByKey('name') }}' width="50">
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div id="kt_aside_menu_wrapper" class="aside-menu-wrapper flex-column-fluid">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                @foreach ($data as $item)
                    @if($item['type'] == 'header-level-menu')
                        <li class="menu-section" id="{{ $item['id'] }}">
                            <h4 class="menu-text">{{ __($item['title']) }}</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                    @elseif($item['type'] == 'single-level-menu')
                        @if(CheckPermissionOrRole(isset($item['permissions']) ? $item['permissions'] : '', isset($item['roles']) ? $item['roles'] : ''))
                            <li class="menu-item" id="{{ $item['id'] }}" aria-haspopup="true">
                                <a href="{{ isset($item['route']) ? route($item['route']) : $item['link'] }}" class="menu-link" target="{{ $item['target'] ?? '' }}">
                                    <span class="svg-icon menu-icon">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </span>
                                    <span class="menu-text">{{ __($item['title']) }}</span>
                                </a>
                            </li>
                        @endif
                    @elseif($item['type'] == 'multi-level-menu')
                        <li class="menu-item menu-item-submenu" id="{{ $item['id'] }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <i class="kt-menu__link-icon {{ $item['icon'] }}"></i>
                                </span>
                                <span class="menu-text">{{ __($item['title']) }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    @foreach ($item['parents'] as $key => $child)
                                        @if(CheckPermissionOrRole(isset($child['permissions']) ? $child['permissions'] : '', isset($child['roles']) ? $child['roles'] : ''))
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{ isset($child['route']) ? route($child['route']) : $child['link'] }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-line"> <span></span> </i>
                                                    <span class="menu-text">{{ __($child['title']) }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside-->
