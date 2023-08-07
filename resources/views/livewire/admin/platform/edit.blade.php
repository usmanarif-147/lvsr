<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ url('admin/platforms') }}"> Platforms </a> / {{ $heading }}
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <form wire:submit.prevent="update">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        @if ($icon && !is_string($icon))
                                            <img src="{{ $icon->temporaryUrl() }}" alt="user-avatar"
                                                class="d-block rounded" height="200" width="170">
                                        @else
                                            <img src="{{ asset(isImageExist($icon_preview)) }}" alt="user-avatar"
                                                class="d-block rounded" height="200" width="170">
                                        @endif

                                        <div wire:loading wire:target="icon" wire:key="icon">
                                            <i class="fa fa-spinner fa-spin mt-2 ml-2"></i>
                                        </div>

                                        <div class="icon-upload btn btn-primary">
                                            <span>Upload Icon</span>
                                            <input type="file" class="icon-input" wire:model="icon"
                                                accept="image/png, image/jpeg, image/jpg, image/webp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Title <span class="text-danger"> * </span>
                                        @error('title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="title" class="form-control"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Base URL
                                    </label>
                                    <input type="text" wire:model="base_url" class="form-control"
                                        placeholder="Enter Base URL i.e https://facebook.com/">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Placeholder (English)
                                    </label>
                                    <input type="text" wire:model="placeholder_en" class="form-control"
                                        placeholder="Enter placeholder in English">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Placeholder (French)
                                    </label>
                                    <input type="text" wire:model="placeholder_fr" class="form-control"
                                        placeholder="Enter placeholder in French">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Placeholder (Spanish)
                                    </label>
                                    <input type="text" wire:model="placeholder_sp" class="form-control"
                                        placeholder="Enter placeholder in Spanish">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Description (English)
                                    </label>
                                    <input type="text" wire:model="description_en" class="form-control"
                                        placeholder="Enter description in English">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Description (French)
                                    </label>
                                    <input type="text" wire:model="description_fr" class="form-control"
                                        placeholder="Enter description in French">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Description (Spanish)
                                    </label>
                                    <input type="text" wire:model="description_sp" class="form-control"
                                        placeholder="Enter description in Spanish">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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

        // window.addEventListener('show-create-modal', event => {
        //     $('#createMerchantModal').modal('show')
        // });

        // window.addEventListener('show-edit-modal', event => {
        //     $('#editMerchantModal').modal('show')
        // });

        // window.addEventListener('edit-password-modal', event => {
        //     $('#editPasswordModal').modal('show')
        // });

        // window.addEventListener('edit-balance-modal', event => {
        //     $('#editBalanceModal').modal('show')
        // });

        // window.addEventListener('close-modal', event => {
        //     $('#createMerchantModal').modal('hide');
        //     $('#editMerchantModal').modal('hide')
        //     $('#confirmModal').modal('hide');
        //     $('#editPasswordModal').modal('hide')
        //     $('#editBalanceModal').modal('hide')
        // });

        // window.addEventListener('open-confirm-modal', event => {
        //     $('#confirmModal').modal('show');
        // });
    </script>
@endsection
