<div class="p-4 bg-white shadow-sm d-flex justify-content-between mb-4 icon-raduis">
    <div>Notifications</div>
    <div class="px-3 tiny-font py-1 bg-theme-color rounded-pill">
        <small class="text-white">+0</small> 
    </div>
</div>
<div class="alert alert-info border border-light icon-raduis">
    <div class="bg-info p-3 d-flex my-4 align-items-center justify-content-between">
        <div class="text-white">New Users</div>
        <div class="px-3 tiny-font py-1 bg-theme-color rounded-pill">
            <small class="text-white">+10</small> 
        </div>
    </div>
    @set('users', \App\Models\User::latest()->take(4)->get())
    @if(empty($users))
        <div class="alert alert-danger">No recent users</div>
    @else
        @foreach($users as $user)
            <div class="p-3 bg-white mb-4 icon-raduis shadow-sm d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        @if(empty($user->profile->image))
                            <div class="text-center text-main-dark border rounded-circle" style="height: 35px; width: 35px; line-height: 35px; background-color: {{ randomrgba() }};">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @else
                            <div class="border rounded-circle" style="height: 35px; width: 35px;">
                                <img src="{{ $user->profile->image->link }}" class="img-fluid rounded-circle w-100 h-100">
                            </div>  
                        @endif
                    </div> 
                    <div class="">
                        <a href="{{ route('admin.user.profile', ['id' => $user->id]) }}">
                            <small class="text-main-dark d-block">
                                {{ \Str::limit($user->name, 12) }}
                            </small>
                        </a> 
                        <small class="text-muted tiny-font">
                            {{ ucwords($user->created_at->diffForHumans()) }}
                        </small>
                    </div>
                </div> 
                <div class="rounded-circle bg-{{ strtolower($user->status) === 'active' ? 'success' : 'danger' }} text-center" style="height: 20px; width: 20px; line-height: 15px;">
                    <small class="text-white tiny-font">
                        <i class="icofont-tick-mark"></i>
                    </small>
                </div>
            </div>
        @endforeach
    @endif
</div>