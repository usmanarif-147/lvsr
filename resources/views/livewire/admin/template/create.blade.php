<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ url('admin/templates') }}"> Templates </a> / {{ $heading }}
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">

                                    @error('image')
                                        <span class="text-danger error-message">{{ $message }}</span>
                                    @enderror

                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        @if ($image && !is_string($image))
                                            <img src="{{ $image->temporaryUrl() }}" alt="user-avatar"
                                                class="d-block rounded" height="200" width="170">
                                        @else
                                            <img src="{{ asset(isImageExist('frame_2.webp')) }}" alt="user-avatar"
                                                class="d-block rounded" height="200" width="170">
                                        @endif
                                        <div wire:loading wire:target="image" wire:key="image">
                                            <i class="fa fa-spinner fa-spin mt-2 ml-2"></i>
                                        </div>

                                        <div class="icon-upload btn btn-primary">
                                            <span>
                                                Upload Image
                                            </span>
                                            <input type="file" class="icon-input" wire:model="image"
                                                accept="image/png, image/jpeg, image/jpg, image/webp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Type <span class="text-danger"> * </span>
                                        @error('type')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <select class="form-select" wire:model="type">
                                        <option selected="">Select</option>
                                        <option value="1">Free</option>
                                        <option value="2">Pro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                icon: event.detail.type,
            });
        });
    </script>
@endsection
