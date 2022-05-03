@if(!empty($roles))
    <div class="row">
        @foreach($roles as $role)
            <div class="col-12 col-md-3 col-lg-2 mb-4">
                <a href="{{ route('admin.users.role', ['role' => strtolower($role)]) }}" class="btn border-dark btn-block">
                    <small class="text-dark">({{ \App\Models\User::where(['role' => $role])->count() }}) {{ ucfirst($role) }}(s)</small> 
                </a>
            </div>
        @endforeach
    </div>
@endif