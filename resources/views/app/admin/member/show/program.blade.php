<div class="row">
    @forelse ($programs as $program)
    <div class="col-md-6 col-xl-4">
        <div class="card shadow-lg">
            <img class="card-img-top img-fluid" src="{{ url($program->programClass->thumbnail) }}"
                alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title text-capitalize">{{ $program->programClass->nama }}</h4>
                <p class="card-text">{{ $program->programClass->deskripsi }}</p>
            </div>
        </div>

    </div>
    @empty
        Tida ada data program!
    @endforelse
</div>
