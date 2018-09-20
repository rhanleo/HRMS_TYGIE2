<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>{{$setting->website}} - {{ $pageTitle }}</title>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
{{--{{HTML::style("http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all")}}--}}
{{ HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css")}}
{{ HTML::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css")}}
{{ HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css")}}
{{ HTML::style("assets/global/plugins/uniform/css/uniform.default.css")}}
{{ HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}

@yield('head')

{{ HTML::style("assets/global/css/components.css")}}
{{ HTML::style("assets/global/css/plugins.css")}}
{{ HTML::style("assets/admin/layout/css/layout.css")}}
{{-- {{ HTML::style("assets/admin/layout/css/themes/$setting->admin_theme.css")}} --}}
{{ HTML::style("assets/admin/layout/css/custom.css")}}
{{ HTML::style('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}
<link rel="stylesheet" href="{{ url( 'assets/global/css/custom.min.css' ) }}">
{{HTML::style("assets/global/css/modified.css")}}





