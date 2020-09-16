<div class="sidebar">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
  -->
    <div class="sidebar-wrapper">
        <div class="logo">

            <a href="javascript:void(0)" class="simple-text logo-normal">
                پنل کاربری
            </a>
        </div>
        <ul class="nav">
            <li class="{{\Illuminate\Support\Facades\Route::currentRouteName()=='panel.index'?"active":""}}">
                <a href="{{route('panel.index')}}">
                    <i class="tim-icons icon-atom"></i>
                    <p>داشبورد</p>
                </a>
            </li>
            <li class="{{\Illuminate\Support\Facades\Route::currentRouteName()=='panel.profile.index'?"active":""}}">
                <a href="{{route('panel.profile.index')}}">
                    <i class="tim-icons icon-badge"></i>
                    <p>پروفایل</p>
                </a>
            </li>

            <li class="{{\Illuminate\Support\Facades\Route::currentRouteName()=='panel.device.index'?"active":""}}">
                <a href="{{route('panel.device.index')}}">
                    <i class="tim-icons icon-mobile active"></i>
                    <p>دستگاه ها</p>
                </a>
            </li>
            <li class="{{\Illuminate\Support\Facades\Route::currentRouteName()=='panel.log'?"active":""}}">
                <a href="{{route('panel.log')}}">
                    <i class="tim-icons icon-notes"></i>
                    <p>گزارشات</p>
                </a>
            </li>
            <li>
                <a href="{{route('logout')}}">
                    <i class="tim-icons icon-button-power"></i>
                    <p>خروج</p>
                </a>
            </li>

        </ul>
    </div>
</div>
