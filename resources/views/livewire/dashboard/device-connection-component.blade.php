<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="text-muted font-semibold">Connected Devices</h6>
        @if ($isLoaded)
            <h6 class="font-extrabold mb-0">{{ $connectedDevices }}</h6>
        @else
            <div class="loader"></div>
        @endif
    </div>
</div>
