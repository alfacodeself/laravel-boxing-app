<div class="row">
    @forelse ($programMembers as $pm)
    <div class="col-xl-6">
        <div class="card shadow-lg">
            <div class="card-body widget-user">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-lg me-3">
                        <img src="{{ $pm->member->foto == null ? asset('assets/images/default-avatar.png') : url($pm->member->foto) }}" class="img-fluid rounded-circle"
                            alt="user">
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="mt-0 mb-1">{{ $pm->member->nama }}</h5>
                        <p class="text-muted mb-2 font-13 text-truncate">{{ $pm->member->nomor_hp }}</p>
                        <small class="text-warning"><b>Bergabung {{ $pm->created_at->diffForHumans() }}</b></small>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @empty
        Tidak ada anggota!
    @endforelse
</div>