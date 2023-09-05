<div class="latest-products">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="section-heading">
                  <h2>Tempat Acara</h2>
                  <a href="{{ route('client.venue.index') }}">Lihat Semua Tempat Acara <i class="fa fa-angle-right"></i></a>
              </div>
          </div>

          {{-- start::favorite_venues card --}}
          @if (count($favorite_venues))
            @foreach ($favorite_venues as $venue)
            <div class="col-md-4">
                <a href="{{ route('client.venue.show', $venue->slug) }}">
                    <div class="product-item card-hover-shadow" name="venue-card">
                        @if (count($venue->images))
                            <div class="venue-thumbnail cover-image" style="background-image: {{ "url('" . asset('storage/' . $venue->images[0]->path) . "')" }}"></div>
                        @else
                            <div class="venue-thumbnail cover-image" style="background-image: {{ "url('" . asset('assets/images/client/images/venue-icon-default.png') . "'" }}"></div>
                        @endif
                        <div class="down-content text-center">
                            <h4 class="mb-0">{{ $venue->name }}</h4>
                            <p class="position-static my-4">Kapasitas: {{ $venue->capacity }} orang</p>
                            <a href="{{ route('client.venue.show', $venue->slug)}}" class="filled-button mt-2">Lihat Detail</a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
         @else
            <p class="text-muted text-center">Belum ada Tempat.</p>
         @endif
        {{-- end::favorite_venues card --}}
      </div>
  </div>
</div>