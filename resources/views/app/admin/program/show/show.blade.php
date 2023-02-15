<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <img class="card-img-top img-fluid" src="{{ $programClass->thumbnail }}"
                alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">{{ $programClass->nama }}</h4>
                <p class="card-text">{{ $programClass->deskripsi }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> {{ $programClass->harga_per_bulan }}</li>
                <li class="list-group-item"> {{ $programClass->memberHasProgramClass()->count() }} Anggota </li>
                <li class="list-group-item"> {{ $programClass->programClassHasTrainer()->count() }} Pelatih </li>
            </ul>
        </div>

    </div>
</div>
