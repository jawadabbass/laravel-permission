<!--begin::Notice-->
@if (flash()->message)
<div class="alert alert-{{ flash()->class }} fade show" role="alert">
    {{ flash()->message }}
</div>
@endif
<!--end::Notice-->
