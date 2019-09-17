<input type="hidden" name="id" value="{{ $member->id }}">
<div class="edit-modal-body">
    <div class="edit-modal-info">
        <div class="col-lg-10 col-md-11">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Name" value="{{ $member->name ?? old('name') }}" id="update-name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Email" value="{{ $member->email ?? old('email') }}"  id="update-email" required>
                            <span class="invalid-feedback" role="alert">
                                <strong class="update-email"></strong>
                            </span>

                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="number" placeholder="Phone" value="{{ $member->phone ?? old('phone') }}" id="update-phone" required>

                            <span class="invalid-feedback" role="alert">
                                <strong class="update-phone"></strong>
                            </span>
                    </div>
                </div>
               
            </div>
        </div>
