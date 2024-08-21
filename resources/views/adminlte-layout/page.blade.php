{{--@extends('adminlte-layout.master')--}}

{{--@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')--}}

{{--@if($layoutHelper->isLayoutTopnavEnabled())--}}
    @php( $def_container_class = 'container' )
{{--@else--}}
{{--    @php( $def_container_class = 'container-fluid' )--}}
{{--@endif--}}

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', '')

@section('body_data', '')

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
{{--        @if($layoutHelper->isLayoutTopnavEnabled())--}}
            @include('adminlte-layout.partials.navbar.navbar-layout-topnav')
{{--        @else--}}
{{--            @include('adminlte-layout.partials.navbar.navbar')--}}
{{--        @endif--}}

        {{-- Left Main Sidebar --}}
{{--        @if(!$layoutHelper->isLayoutTopnavEnabled())--}}
            @include('adminlte-layout.partials.sidebar.left-sidebar')
{{--        @endif--}}

        {{-- Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

            {{-- Content Header --}}
            <div class="content-header">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                    @yield('content_header')
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content">
                <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                    @yield('content')
                </div>
            </div>

        </div>

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte-layout.partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte-layout.partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
