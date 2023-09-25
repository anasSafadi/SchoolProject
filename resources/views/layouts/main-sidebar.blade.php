@if(Auth::guard('web')->check())
@include("layouts.sidebar.admin")

@elseif(Auth::guard('teacher')->check())
@include("layouts.sidebar.teacher")
@elseif(Auth::guard('student')->check())
    @include("layouts.sidebar.student")
@elseif(Auth::guard('studentparent')->check())
    @include("layouts.sidebar.parents")
    @endif

