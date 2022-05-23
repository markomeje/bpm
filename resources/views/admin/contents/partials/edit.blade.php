<div class="modal fade" id="edit-content-{{ $content->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="edit-content-form" data-action="{{ route('admin.content.edit', ['id' => $content->id]) }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0 font-weight-bold">Edit Content</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Title</label>
                            <input type="text" class="form-control title" name="title" placeholder="e.g., Buy, Rent or Sell Real Estate Properties." value="{{ $content->title }}">
                            <small class="invalid-feedback title-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Pages</label>
                            <select class="form-control custom-select page" name="page">
                                <option value="">Select Page</option>
                                @set('pages', \App\Models\Content::$pages)
                                @if(empty($pages))
                                    <option value="">No pages</option>
                                @else
                                    @foreach ($pages as $page)
                                        <option value="{{ $page }}" {{ $content->page == $page ? 'selected' : '' }}>
                                            {{ ucfirst($page) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback page-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Sections</label>
                            <select class="form-control custom-select section" name="section">
                                <option value="">Select Section</option>
                                @for ($section = 1; $section <= 5; $section++)
                                    <option value="{{ $section }}" {{ $content->section == $section ? 'selected' : '' }}>
                                        Section {{ $section }}
                                    </option>
                                @endfor
                            </select>
                            <small class="invalid-feedback section-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Status</label>
                            <select class="form-control custom-select status" name="status">
                                <option value="">Select Status</option>
                                @set('status', \App\Models\Content::$status)
                                @if(empty($status))
                                    <option value="">No status</option>
                                @else
                                    @foreach ($status as $state)
                                        <option value="{{ $state }}" {{ $content->status == $state ? 'selected' : '' }}>
                                            {{ ucfirst($state) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="invalid-feedback status-error"></small>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="text-main-dark">Content</label>
                        <textarea class="form-control content" name="content" rows="4" placeholder="Enter content here">{{ $content->content }}</textarea>
                        <small class="invalid-feedback content-error"></small>
                    </div>
                    <div class="alert mb-3 edit-content-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info btn-lg text-white edit-content-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none edit-content-spinner mb-1">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>