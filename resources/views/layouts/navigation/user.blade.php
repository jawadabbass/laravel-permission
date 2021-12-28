@if(isAllowed('View Users'))
<li>
    <a href="javascript:;">{{ __('Users') }}</a>
    <div>
        <ul>
            <li>
                <a href="{{ route(config('jawad_permission_uuid.route_name').'users.index') }}">{{ __('Users') }}</a>
            </li>
        </ul>
    </div>
</li>
@endif
