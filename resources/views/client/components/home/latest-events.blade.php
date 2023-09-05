<div class="latest-products">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="section-heading">
                  <h2>Acara Terbaru</h2>
                  <a href="{{ route('client.gallery.index') }}">Lihat Semua Acara <i class="fa fa-angle-right"></i></a>
              </div>
          </div>

          @if (count($latest_events))
            @foreach ($latest_events as $event)
            <div class="col-md-4">
                <a href="{{ route('client.gallery.show', $event->slug) }}">
                    <div class="product-item card-hover-shadow" name="venue-card">
                        @if ($event->gallery)
                            <div class="venue-thumbnail cover-image" style="background-image: {{ "url('" . asset('storage/' . $event->gallery->images[0]->path) . "')" }}"></div>
                        @else
                            <div 
                                class="venue-thumbnail cover-image default-image" 
                                style="background-image: {{ "url('" . asset('assets/images/client/images/default-event-image.png') . "'" }}"
                            ></div>
                        @endif
                        <div class="down-content text-center">
                            <h4 class="mb-0">{{ $event->title }}</h4>
                            <p class="position-static my-4">Tanggal: {{ date_format(date_create(explode(' ', $event->transaction->datetime)[0]),"d/m/Y H:i") }}</p>
                            <button class="filled-button mt-2">Lihat Detail</button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
          @else
          <p class="text-center text-muted">Belum Ada Event</p>
          @endif
      </div>
  </div>
</div>