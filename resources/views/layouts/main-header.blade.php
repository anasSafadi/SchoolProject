
<style>
    span{
      font-weight: bold;
        font-family: "Simplified Arabic";
        font-size: 16px;
    }
    .double_line {
        font-weight: bold;
        font-family: "Simplified Arabic";
        font-size: 16px;
    }
    input{font-weight: bold;font-size: 40px}

</style>

@if(Auth::guard('web')->check())
    @include("layouts.header-side.admin")

@elseif(Auth::guard('teacher')->check())
    @include("layouts.header-side.teacher")
@elseif(Auth::guard('student')->check())
    @include("layouts.header-side.student")
@elseif(Auth::guard('studentparent')->check())
    @include("layouts.header-side.parents")
@endif


