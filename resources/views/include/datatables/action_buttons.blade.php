@if(isset($edit) && !empty($edit))
    <a class="btn btn-sm btn-primary btn-edit" href="{{ $edit }}">
        Edit
    </a> 
@endif
@if(isset($whatsapp) && !empty($whatsapp))
    <a class="btn btn-sm btn-success btn-whatsapp" href="https://wa.me/{{$whatsapp}}" target="_blank">
        Feedback
    </a> 
@endif
@if(isset($detail) && !empty($detail))
    <a class="btn btn-sm btn-primary btn-detail" href="{{ $detail }}" style="width: 72px;">
        Detail
    </a> 
@endif

@if(isset($details) && !empty($details))
    <a  href="{{ $details }}">Detail</a> 
@endif

@if(isset($destroy) && !empty($destroy))
    <form onsubmit="return confirm('Apakah anda yakin hapus?');" action="{{ $destroy }}" method="post">
        @csrf
        @method('DELETE')
        @if(isset($edits) && !empty($edits))
            <a class="btn btn-sm btn-primary btn-edit" href="{{ $edits }}">
                Edit
            </a>
        @endif
        <button class="btn btn-sm btn-danger" type="submit">
            Hapus
        </button>
        @if(isset($image) && !empty($image))
            <a class="btn btn-sm btn-success btn-image" href="{{ $image }}">
                Image
            </a> 
        @endif
        @if(isset($outcome) && !empty($outcome))
            <a class="btn btn-sm btn-secondary btn-outcome" href="{{ $outcome }}">
                Outcome
            </a> 
        @endif
    </form>
@endif
@if(isset($reply) && !empty($reply))
    <a class="btn btn-sm btn-success btn-whatsapp" target="_blank" href="https://wa.me/{{$reply}}">
        Reply
    </a> 
@endif

