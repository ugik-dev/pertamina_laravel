<div class="row mt-2">
    <label class="col-{{ $col_1 }} col-form-label" for="{{ $id }}">{{ $label }}</label>
    <div class="col-{{ $col_2 }}">
        <div class="input-group">
            <input id="{{ $id }}" name="{{ $id }}" class="form-control" value="{{ $value }}">
            @if (!empty($span))
                <span class="input-group-text">{!! $span !!}</span>
            @endif
        </div>
    </div>
</div>
