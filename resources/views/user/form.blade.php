<div class="form-group">
    <label for="name" class="control-label">Имя</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', $user->name) }}">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="email" class="control-label">Имя</label>
    @if($user->profile)
        <input class="form-control" name="firstname" type="text" id="firstname"
               value="{{ old('name', $user->profile->firstname) }}">
    @else
        <input class="form-control" name="firstname" type="text" id="firstname">
    @endif
    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="email" class="control-label">Фамилия</label>
    @if($user->profile)
        <input class="form-control" name="surname" type="text" id="surname"
               value="{{ old('name', $user->profile->surname) }}">
    @else
        <input class="form-control" name="surname" type="text" id="surname">
    @endif
    {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="email" class="control-label">Email</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ old('email', $user->email) }}">
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="email" class="control-label">API Key</label>
    @if($user->profile)
        <input class="form-control" name="api_key" type="text" id="api_key"
               value="{{ old('name', $user->profile->api_key) }}">
    @else
        <input class="form-control" name="api_key" type="text" id="api_key">
    @endif
    {!! $errors->first('api_key', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="password" class="control-label">Пароль</label>
    <input class="form-control" name="password" type="password" id="password" autocomplete="new-password">
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="role" class="control-label">Роль</label>
    <select name="role" id="role" class="custom-select">
        @foreach($roles as $id => $role)
            <option value="{{ $id }}" {{ $user->hasRole($id) ? 'selected' : ''}}>{{ $role }}</option>
        @endforeach
    </select>
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>



