<div class="form-group">
    <label>Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name')?? $company->name}}">
    <small class="text-danger"> {{ $errors->first('name') }} </small> 
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email')?? $company->email}}">
    <small class="text-danger"> {{ $errors->first('email') }} </small> 
</div>
<div class="form-group">
    <label>Logo:</label>
    <input type="file" class="form-control" id="logo" name="logo" onchange="readURL(this);">
    <small class="text-danger"> {{ $errors->first('logo') }} </small> 
    @if($company->logo && $company->logo != null)
    <div class="form-group">
        <img src="{{ asset('storage/'.$company->logo) }}" height="100" width="200">
    </div>
    @endif
</div>
<div class="form-group">
    <label>Website:</label>
    <input type="url" class="form-control" id="website" placeholder="Enter website" name="website" value="{{ old('website')?? $company->website}}">
    <small class="text-danger"> {{ $errors->first('website') }} </small> 
</div>
@csrf