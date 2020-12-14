@php
    use App\Traits\BaseTrait;
@endphp
<aside class="sidebar ">
    <div class="scrollbar">
        <div class="user">
            <div class="user__info">
                <img class="user__img" src="{{ (Auth::user()->avatar != "")?url(Auth::user()->avatar):url('/uploads/avatar/avatar-default-icon.png') }}" alt="">
                <div style="word-break: break-all">
                    <div class="user__name">{{ Auth::user()->name }}</div>
                    <div class="user__email">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
        <ul class="navigation">

            <li class="{{ ($sidebar['menu'] == 'my_account')?'navigation__active':'' }}">
                <a href="{{ url('/user/my-account') }}"><i class="zwicon-user-circle"></i> {{__('global.side.my_account')}}</a>
            </li>
            @if(Auth::user()->role == 1)
                <li class="navigation__sub {{ ($sidebar['menu'] == 'user_management')?'navigation__sub--active':'' }}">
                    <a href="javascript:"><i class="zwicon-users"></i> {{__('global.side.user_management')}} <i class="zwicon-arrow-down"></i></a>
                    <ul>
                        <li class="{{ ($sidebar['sub_menu'] == 'change_role')?'navigation__active':'' }}">
                            <a href="{{ url('/user/change-role') }}"> {{__('global.common.change').' '.__('global.common.role')}}</a>
                        </li>
                        <li class="{{ ($sidebar['sub_menu'] == 'admin')?'navigation__active':'' }}">
                            <a href="{{ url('/user/admins') }}"> Teachers</a>
                        </li>
                        <li class="{{ ($sidebar['sub_menu'] == 'user')?'navigation__active':'' }}">
                            <a href="{{ url('/user/users') }}"> Students</a>
                        </li>

                    </ul>
                </li>
            @endif

            <li>
                <a href="javascript:" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="zwicon-arrow-circle-right"></i> {{ __('global.side.logout') }}</a>
            </li>
        </ul>
    </div>
</aside>
