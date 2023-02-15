<section class="team-section spad" id="trainer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="team-title">
                    <div class="section-title">
                        <span>Our Trainer</span>
                        <h2>TRAIN WITH EXPERTS</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ts-slider owl-carousel">
                @foreach ($trainers as $trainer)
                <div class="col-lg-4">
                    <div class="ts-item set-bg" data-setbg="{{ url($trainer->foto) }}">
                        <div class="ts_text text-capitalize">
                            <h4>{{ $trainer->nama }}</h4>
                            <span>Trainer</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>