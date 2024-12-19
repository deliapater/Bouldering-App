{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Techniques" icon="la la-question" :link="backpack_url('technique')" />
<x-backpack::menu-item title="Gears" icon="la la-question" :link="backpack_url('gear')" />
<x-backpack::menu-item title="Locations" icon="la la-question" :link="backpack_url('location')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />