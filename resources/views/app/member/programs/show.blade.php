<div class="row">
    @forelse ($data as $d)
    <div class="col-xl-6">
        <div class="card shadow-lg">
            <div class="card-body widget-user">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-lg me-3">
                        <img src="{{ $d->foto == null ? asset('assets/images/default-avatar.png') : url($d->foto) }}" class="img-fluid rounded-circle"
                            alt="foto">
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="mt-0 mb-1">{{ $d->nama }}</h5>
                        <p class="text-muted mb-2 font-13 text-truncate">{{ $d->nomor_hp }}</p>
                        {{-- <small class="text-warning"><b>Bergabung {{ $pm->created_at->diffForHumans() }}</b></small> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    @empty
        Tidak ada data!
    @endforelse
</div>