<?


// app/Http/Controllers/UserController.php

<form action="{{ route('sekretariat2-update', ['NIP' => $user->NIP]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }} <!-- Use PATCH method for updates -->

    <div class="form-group">
        <label for="username">NIP</label>
        <input type="text" class="form-control" name="NIP" value="{{ old('NIP', $user->NIP) }}" tabindex="1" required autofocus>
        <div class="invalid-feedback">
            Isi NIP Dosen
        </div>
    </div>

    <!-- Other input fields with similar modifications -->

    <div class="row-group">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
        </div>
    </div>
</form>
