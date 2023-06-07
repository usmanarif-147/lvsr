<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ url('admin/background-colors') }}"> Plans </a> / {{ $heading }}
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
                                    <label class="form-label">
                                        Title <span class="text-danger"> * </span>
                                        @error('title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" class="form-control" wire:model="title" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Amount <span class="text-danger"> * </span>
                                        @error('amount')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" class="form-control" wire:model="amount" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Billing Cycle <span class="text-danger"> * </span>
                                        @error('interval')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <select class="form-select" wire:model="interval">
                                        <option value="0" selected="">Select</option>
                                        @foreach ($billing_cycles as $key => $int)
                                            <option value="{{ $key }}"> {{ $int }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" {{ $isDisabled ? 'disabled' : '' }} class="btn btn-primary">Save</button>
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
