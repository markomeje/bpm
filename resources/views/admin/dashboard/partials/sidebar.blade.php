@can('view', ['users'])
    <div class="p-4 bg-white shadow-sm d-flex justify-content-between mb-4 icon-raduis">
        <div class="text-main-dark">New Users</div>
        <div class="px-3 tiny-font py-1 bg-theme-color rounded-pill">
            <small class="text-white">
                +{{ \App\Models\User::latest()->count() }}
            </small> 
        </div>
    </div>
    <div class="alert alert-info pt-4 border border-light icon-raduis">
        @set('users', \App\Models\User::latest()->take(4)->get())
        @if(empty($users))
            <div class="alert alert-danger">No recent users</div>
        @else
            @foreach($users as $user)
                <div class="p-3 bg-white mb-4 icon-raduis shadow-sm d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        @if(empty($user->profile))
                            <div class="mr-2">
                                <div class="text-center text-main-dark border rounded-circle" style="height: 35px; width: 35px; line-height: 35px; background-color: {{ randomrgba() }};">&</div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="javascript:;">
                                    <small class="text-main-dark d-block">No Profile</small>
                                </a> 
                                <small class="text-muted tiny-font">
                                    {{ ucwords($user->created_at->diffForHumans()) }}
                                </small>
                            </div>
                        @else
                            <div class="mr-2">
                                @if(empty($user->profile->image))
                                    <div class="text-center border rounded-circle" style="height: 35px; width: 35px; line-height: 35px; background-color: {{ randomrgba() }};">
                                        <small class="text-main-dark">
                                            {{ substr($user->name, 0, 1) }}
                                        </small>
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
                        @endif
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
@endcan