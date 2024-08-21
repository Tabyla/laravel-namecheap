@if(!$nameserver)
    <input type="hidden" id="domain" name="domain" value="{{ $domain }}">
    <div class="form-group">
        <label for="nameserver" class="form-label">NS запись</label>
        <input type="text" class="form-control" id="nameserver" name="nameserver"
               value="{{ old('nameserver') }}" required>
        {!! $errors->first('nameserver', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group">
        <label for="ip_address" class="form-label">IP адрес</label>
        <input type="text" class="form-control" id="ip_address" name="ip_address"
               value="{{ old('ip_address') }}" required>
        {!! $errors->first('ip_address', '<p class="help-block">:message</p>') !!}
    </div>
@else
    <input type="hidden" id="id" name="id" value="{{ $nameserver->id }}">
    <div class="form-group">
        <label for="ip_address" class="form-label">IP адрес</label>
        <input type="text" class="form-control" id="ip_address" name="ip_address"
               value="{{ old('ip_address', $nameserver->ip) }}" required>
        {!! $errors->first('ip_address', '<p class="help-block">:message</p>') !!}
    </div>
@endif



