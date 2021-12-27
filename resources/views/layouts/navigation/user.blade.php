@if(isAllowed('View Users'))
<li>
    <a href="javascript:;">{{ __('Users') }}</a>
    <div>
        <ul>
            <li>
                <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
            </li>
        </ul>
    </div>
</li>
@endif
