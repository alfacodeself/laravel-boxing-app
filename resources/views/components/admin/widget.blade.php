<div class="card shadow-lg">
    <div class="card-body">
        
        <h4 class="header-title mt-0 mb-1">{{ $title }}</h4>

        <div class="widget-box-2">
            <div class="widget-detail-2 text-end">
                {{$slot}}
                <h2 class="fw-normal mb-1"> {{ $value }} </h2>
                <p class="text-muted">Total {{ $title }}</p>
            </div>
        </div>
    </div>
</div>
