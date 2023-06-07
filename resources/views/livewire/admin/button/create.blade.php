<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ url('admin/button-colors') }}"> Button Colors </a> / {{ $heading }}
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
                                        Pick Color <span class="text-danger"> * </span>
                                        @error('color')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="color" wire:model="color"
                                        wire:change="selectColor($event.target.value)" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Name
                                    </label>
                                    <input type="text" id="colorName" class="form-control" wire:model="name"
                                        placeholder="Color Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Color Code
                                    </label>
                                    <input type="text" id="colorCode" class="form-control" wire:model="color_code"
                                        placeholder="Color Code">
                                </div>
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
                                        <option value="0" selected="">Select</option>
                                        <option value="1">Free</option>
                                        <option value="2">Pro</option>
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
        function showColorInfo(color) {
            var colorName = getColorHexCode(color);
            var hexCode = color.toUpperCase();

            $.ajax({
                url: 'https://www.thecolorapi.com/id?hex=' + hexCode.slice(1),
                type: 'get',
                success: function(res) {
                    $('#colorCode').val(res.hex.value);
                    $('#colorName').val(res.name.value);
                    Livewire.emit('colorInfo', [res.hex.value, res.name.value]);
                }
            })

        }

        function getColorHexCode(color) {
            var tempElement = document.createElement("div");
            tempElement.style.color = color;
            var colorName = window.getComputedStyle(tempElement).color;

            // Extract the color name from the computed style
            var matches = colorName.match(/\((.*?)\)/);
            if (matches) {
                var colorValues = matches[1].split(",");
                if (colorValues.length >= 3) {
                    colorName = getColorNameFromRGB(colorValues);
                }
            }

            return colorName;
        }

        window.addEventListener('color-info', event => {
            showColorInfo(event.detail.color);
        });

        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                icon: event.detail.type,
            });
        });
    </script>
@endsection
