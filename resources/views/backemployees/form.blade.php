<div class="form-group">
    <label>Company:</label>
    <select class="select2 form-control" name="company_id">
        @foreach($companies as $company)
        <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : '' }}> {{ $company->name }}</option>
        @endforeach
    </select>
    <small class="text-danger"> {{ $errors->first('company_id') }} </small>
</div>
<div class="form-group">
    <label>First Name:</label>
    <input type="text" class="form-control" id="first-name" placeholder="Enter first name" name="first_name" value="{{ old('first_name')?? $employee->first_name}}">
    <small class="text-danger"> {{ $errors->first('first_name') }} </small> 
</div>
<div class="form-group">
    <label>Last Name:</label>
    <input type="text" class="form-control" id="last-name" placeholder="Enter last name" name="last_name" value="{{ old('last_name')?? $employee->last_name}}">
    <small class="text-danger"> {{ $errors->first('last_name') }} </small> 
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email')?? $employee->email}}">
    <small class="text-danger"> {{ $errors->first('email') }} </small> 
</div>
<div class="form-group">
    <label>Phone Number:</label>
    <input type="number" class="form-control" id="phone-number" placeholder="Enter phone number" name="phone_number" value="{{ old('phone_number')?? $employee->phone_number}}">
    <small class="text-danger"> {{ $errors->first('phone_number') }} </small> 
</div>
@csrf