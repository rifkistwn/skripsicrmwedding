<div class="latest-products">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="section-heading">
                  <h2>Paket Terbaru</h2>
                  <a href="{{ route('client.packet.index') }}">Lihat Semua Paket <i class="fa fa-angle-right"></i></a>
              </div>
          </div>

        {{-- start::new_packets card --}}
        @if (count($new_packets))
            @foreach ($new_packets as $packet)
            <div class="col-md-4">
                <a href="{{ route('client.packet.show', $packet->code) }}">
                <div class="product-item card-hover-shadow" name="packet-card">
                    <div class="packet-thumbnail cover-image" style="background-image: {{ "url('" . asset("storage/{$packet->image}") . "')" }}"></div>
                    <div class="down-content text-center">
                        <h4 class="mb-0">{{ $packet->name }}</h4>
                        <p class="position-static my-4 font-weight-bold">Rp. {{ number_format($packet->price) }},-</p>
                        <button class="filled-button mt-2">Lihat Selengkapnya</button>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        @else
            <p class="text-muted text-center">Belum ada paket.</p>
        @endif
        {{-- end::new_packets card --}}
      </div>
  </div>
</div>