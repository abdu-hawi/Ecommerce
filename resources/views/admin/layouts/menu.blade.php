<li class="nav-item">
    <a href="{!! aurl('') !!}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            {!! trans('admin.dashboard') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('admin') !!}" class="nav-link {!! active_menu('admin')[0] !!}">
        <i class="nav-icon fas fa-user-astronaut"></i>
        <p>
            {!! trans('admin.admin_account') !!}
        </p>
    </a>
</li>

<li class="nav-item has-treeview {!! active_menu('users')[1] !!}">
    <a href="" class="nav-link {!! active_menu('users')[0] !!}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            {!! trans('admin.users_account') !!}
            <i class="right fas fa-angle-{!! angle() !!}"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{!! aurl('users') !!}" class="nav-link {!! preg_match('/users$/i',$_SERVER['REQUEST_URI'])?'active':'' !!}">
                <i class="far fa-circle nav-icon"></i>
                <p>{!! trans('admin.all_users') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! aurl('users') !!}?level=user" class="nav-link {!! preg_match('/user$/i',$_SERVER['REQUEST_URI'])?'active':'' !!}">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>{!! trans('admin.users') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! aurl('users') !!}?level=vendor" class="nav-link {!! preg_match('/vendor$/i',$_SERVER['REQUEST_URI'])?'active':'' !!}">
                <i class="far fa-circle nav-icon text-info"></i>
                <p>{!! trans('admin.vendors') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! aurl('users') !!}?level=company" class="nav-link {!! preg_match('/company$/i',$_SERVER['REQUEST_URI'])?'active':'' !!}">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>{!! trans('admin.companies') !!}</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{!! aurl('settings') !!}" class="nav-link {!! active_menu('settings')[0] !!}">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
            {!! trans('admin.settings') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('countries') !!}" class="nav-link {!! active_menu('countries')[0] !!}">
        <i class="nav-icon fas fa-flag"></i>
        <p>
            {!! trans('admin.countries') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('cities') !!}" class="nav-link {!! active_menu('cities')[0] !!}">
        <i class="nav-icon fas fa-city"></i>
        <p>
            {!! trans('admin.cities') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('districts') !!}" class="nav-link {!! active_menu('districts')[0] !!}">
        <i class="nav-icon fas fa-warehouse"></i>
        <p>
            {!! trans('admin.districts') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('sections') !!}" class="nav-link {!! active_menu('sections')[0] !!}">
        <i class="nav-icon fas fa-list"></i>
        <p>
            {!! trans('admin.sections') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('trademarks') !!}" class="nav-link {!! active_menu('trademarks')[0] !!}">
        <i class="nav-icon fas fa-trademark"></i>
        <p>
            {!! trans('admin.trademarks') !!}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('manufacturers') !!}" class="nav-link {!! active_menu('manufacturers')[0] !!}">
        <i class="nav-icon fas fa-industry"></i>
        <p>
            {!! trans('admin.manufacturers') !!}
        </p>
    </a>
</li>



<!--
<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Starter Pages
            <i class="right fas fa-angle-{!! angle() !!}"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Simple Link
            <span class="right badge badge-danger">New</span>
        </p>
    </a>
</li>
-->
