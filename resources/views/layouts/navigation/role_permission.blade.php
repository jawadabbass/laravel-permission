@if (isAllowed('View Roles') || isAllowed('View Permissions') || isAllowed('View Permission Groups'))
    <li>
        <a href="javascript:;">
            {{ __('Roles') }} &amp; {{ __('Permissions') }}
        </a>
        <div>
            <ul>
                @if (isAllowed('View Roles'))
                    <li>
                        <a href="{{ route(config('jawad_permission_uuid.route_name').'roles.index') }}">
                            {{ __('Roles') }}
                        </a>
                    </li>
                @endif
                @if (isAllowed('View Permissions'))
                    <li>
                        <a href="{{ route(config('jawad_permission_uuid.route_name').'permissions.index') }}">
                            {{ __('Permissions') }}
                        </a>
                    </li>
                @endif
                @if (isAllowed('View Permission Groups'))
                    <li>
                        <a href="{{ route(config('jawad_permission_uuid.route_name').'permissionGroup.index') }}">
                            {{ __('Permission Groups') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif
