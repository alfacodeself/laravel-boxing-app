<div class="row">
    @forelse ($trainerPrograms as $tp)
    <div class="col-md-6 col-xl-4">
        <div class="card shadow-lg">
            <img class="card-img-top img-fluid" src="{{ url($tp->programClass->thumbnail) }}"
                alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">{{ $tp->programClass->nama }}</h4>
                <p class="card-text">{{ $tp->programClass->deskripsi }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12 col-xl-12">
        <div class="card shadow-lg">
            Tidak ada program!
        </div>
    </div>
    @endforelse
</div>
