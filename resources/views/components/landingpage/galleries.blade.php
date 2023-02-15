<div class="gallery-section">
    <div class="gallery">
        <div class="grid-sizer"></div>
        @foreach ($galleries as $gallery)
        <div class="gs-item grid-wide set-bg" data-setbg="{{ asset($gallery->gambar) }}">
            <a href="{{ asset($gallery->gambar) }}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
        @endforeach
    </div>
</div>
