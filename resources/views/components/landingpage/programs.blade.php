<section class="classes-section spad" id="classes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Classes</span>
                    <h2>WHAT WE CAN OFFER</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($programs as $program)
            <div class="col-lg-4 col-md-6">
                <div class="class-item">
                    <div class="ci-pic">
                        <img src="{{ url($program->thumbnail) }}" alt="">
                    </div>
                    <div class="ci-text">
                        <span>{{ Str::limit($program->deskripsi, 15, '...') }}</span>
                        <h5>{{ $program->nama }}</h5>
                        {{-- <a href="{{ route('class.show') }}"><i class="fa fa-angle-right"></i></a> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
