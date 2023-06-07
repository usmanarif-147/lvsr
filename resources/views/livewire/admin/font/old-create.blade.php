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
                            <div id="container">
                                <h1 style="font-size: 50px;">Font style</h1>
                                <div id="text">
                                    <h1 id="h1">Grumpy wizards make toxic brew for the evil Queen and Jack.</h1>
                                    <h2 id="h2">Grumpy wizards make toxic brew for the evil Queen and Jack.</h2>
                                    {{-- <h3 id="h3">Grumpy wizards make toxic brew for the evil Queen and Jack.</h3>
                                    <h4 id="h4">Grumpy wizards make toxic brew for the evil Queen and Jack.</h4>
                                    <div id="standard">Grumpy wizards make toxic brew for the evil Queen and Jack.
                                    </div> --}}
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Select Font Style <span class="text-danger"> * </span>
                                            @error('font_style')
                                                <span class="text-danger error-message">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select class="form-select" wire:model.lazy="font_style" id='select'
                                            onChange="fontChange();">
                                            @foreach ($styles as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                            <button type="submit" {{ $isDisabled ? 'disabled' : '' }}
                                class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        // $(document).ready(function() {
        //     var fonts = ["Montez", "Lobster", "Josefin Sans", "Shadows Into Light", "Pacifico", "Amatic SC",
        //         "Orbitron",
        //         "Rokkitt", "Righteous", "Dancing Script", "Bangers", "Chewy", "Sigmar One",
        //         "Architects Daughter",
        //         "Abril Fatface", "Covered By Your Grace", "Kaushan Script", "Gloria Hallelujah", "Satisfy",
        //         "Lobster Two",
        //         "Comfortaa", "Cinzel", "Courgette"
        //     ];
        //     var string = "";
        //     var select = document.getElementById("select")
        //     for (var a = 0; a < fonts.length; a++) {
        //         var opt = document.createElement('option');
        //         opt.value = opt.innerHTML = fonts[a];
        //         opt.style.fontFamily = fonts[a];
        //         select.add(opt);
        //     }
        // })



        function fontChange() {
            var x = document.getElementById("select").selectedIndex;
            var y = document.getElementById("select").options;

            document.body.insertAdjacentHTML("beforeend", "<style> #text{ font-family:'" + y[x].text + "';}" +
                "#select{font-family:'" + y[x].text + "';</style>");
            // var tl = new TimelineLite,
            //     mySplitText = new SplitText("#h1", {
            //         type: "words,chars"
            //     }),
            //     chars = mySplitText.chars; //an array of all the divs that wrap each character
            // TweenLite.set("#h1", {
            //     perspective: 400
            // });
            // tl.staggerFrom(chars, 0.2, {
            //     opacity: 0,
            //     scale: 0,
            //     y: 80,
            //     rotationX: 180,
            //     transformOrigin: "0% 50% -50",
            //     ease: Back.easeOut
            // }, 0.01, "+=0");
            // var t2 = new TimelineLite,
            //     mySplitText2 = new SplitText("#h2", {
            //         type: "words,chars"
            //     }),
            //     chars = mySplitText2.chars; //an array of all the divs that wrap each character
            // TweenLite.set("#h2", {
            //     perspective: 400
            // });
            // t2.staggerFrom(chars, 0.2, {
            //     opacity: 0,
            //     scale: 0,
            //     y: 80,
            //     rotationX: 180,
            //     transformOrigin: "0% 100% -50",
            //     ease: Back.easeOut
            // }, 0.01, "+=0");

            // var t3 = new TimelineLite,
            //     mySplitText3 = new SplitText("#h3", {
            //         type: "words,chars"
            //     }),
            //     chars = mySplitText3.chars; //an array of all the divs that wrap each character
            // TweenLite.set("#h3", {
            //     perspective: 400
            // });
            // t3.staggerFrom(chars, 0.2, {
            //     opacity: 0,
            //     scale: 0,
            //     y: 80,
            //     rotationX: 180,
            //     transformOrigin: "0% 150% -50",
            //     ease: Back.easeOut
            // }, 0.01, "+=0");
            // var t4 = new TimelineLite,
            //     mySplitText4 = new SplitText("#h4", {
            //         type: "words,chars"
            //     }),
            //     chars = mySplitText4.chars; //an array of all the divs that wrap each character
            // TweenLite.set("#h4", {
            //     perspective: 400
            // });
            // t4.staggerFrom(chars, 0.2, {
            //     opacity: 0,
            //     scale: 0,
            //     y: 80,
            //     rotationX: 180,
            //     transformOrigin: "0% 200% -50",
            //     ease: Back.easeOut
            // }, 0.01, "+=0");
            // var t5 = new TimelineLite,
            //     mySplitText5 = new SplitText("#standard", {
            //         type: "words,chars"
            //     }),
            //     chars = mySplitText5.chars; //an array of all the divs that wrap each character
            // TweenLite.set("#standard", {
            //     perspective: 400
            // });
            // t5.staggerFrom(chars, 0.2, {
            //     opacity: 0,
            //     scale: 0,
            //     y: 80,
            //     rotationX: 180,
            //     transformOrigin: "0% 250% -50",
            //     ease: Back.easeOut
            // }, 0.01, "+=0");
        }
        // TweenLite.to(page, 0, {
        //     top: "-100vh",
        //     ease: Bounce.easeOut,
        //     delay: 0
        // });
        // TweenLite.to(page, 1, {
        //     top: "0vh",
        //     ease: Elastic.easeOut,
        //     delay: 1
        // });
        // fontChange();
    </script>

    {{-- <script>
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
    </script> --}}
@endsection
