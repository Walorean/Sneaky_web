@extends('admin.admin_layout')
@push('styles')
    @vite(['resources/css/create_panel.css'])
@endpush
@section('admin_content')
    <div class="admin_body">
        <h1><u>ADMIN PANEL - CREATE NEW SHOE</u></h1>

        <div class="admin_form_container">
            <form class="form_sections"
                  method="POST"
                  action="{{ route('admin.product.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="form_section">
                    <h3>Basic Details</h3>

                    <div class="form_field">
                        <label>Product Name *</label>
                        <input type="text" name="name">
                    </div>

                    <div class="form_field">
                        <label>Categories</label>
                        <select class="categories-select" name="categories[]" multiple size="4">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <p class="color_count">Hold Ctrl to select multiple</p>
                    </div>
                    <div class="form_field">
                        <label>Brand *</label>
                        <select class="brand-select" name="brand">
                            <option value="" disabled {{ !request('brand') ? 'selected' : '' }}>-- choose brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand_id }}"
                                    {{ request('brand') == $brand->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_field">
                        <label>Basic Info</label>
                        <textarea name="basic_info" placeholder="Basic information..."></textarea>
                    </div>

                    <div class="form_field">
                        <label>Product Origin Information</label>
                        <input type="text" name="origin" placeholder="e.g., EuroFleet Innovations, Titanium Plaza, 86767 DE Frankfurt am Main, Germany">
                    </div>
                </div>

                <div class="form_section">
                    <h3>Product Specifications</h3>

                    <div class="form_field">
                        <label>Material</label>
                        <input type="text" name="material" placeholder="Basic information about material...">
                    </div>

                    <div class="form_field">
                        <label>Product Code</label>
                        <input type="text" name="product_code" placeholder="e.g., IM8002-030">
                    </div>
                </div>

                <div class="form_section">
                    <h3>Inventory & Pricing</h3>

                    <div class="form_field">
                        <label>Price (EUR)</label>
                        <input type="number" name="price" placeholder="e.g., 129.99" min="0" step="0.01">
                    </div>

                    <div class="form_field">
                        <label>Product Variants</label>

                        <div id="variants_container">
                            @for ($i = 0; $i < $variantsCount; $i++)
                                <div class="variant_row">

                                    <div class="variant_header">
                                        <h3>Shoe {{ $i + 1 }}</h3>
                                        <button type="button" class="remove_variant_btn">✕</button>
                                    </div>

                                    <div class="variant_body">

                                        <label>Color *</label>
                                        <select name="variants[{{ $i }}][color_id]">
                                            <option value="" disabled selected>
                                                -- choose color --
                                            </option>

                                            @foreach($colors as $cl)
                                                <option value="{{ $cl->color_id }}"
                                                    {{ request('color_id') == $cl->color_id ? 'selected' : '' }}>
                                                    {{ $cl->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <label>Size *</label>
                                        <select name="variants[{{ $i }}][size_id]">
                                            <option value="" disabled selected>
                                                -- choose size --
                                            </option>

                                            @foreach($sizes as $sz)
                                                <option value="{{ $sz->size_id }}"
                                                    {{ request('size_id') == $sz->size_id ? 'selected' : '' }}>
                                                    {{ $sz->size }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <label>Stock Quantity *</label>

                                        <input type="number"
                                               name="variants[{{ $i }}][stock_quantity]"
                                               min="1"
                                               placeholder="Stock quantity">

                                        <div class="variant_images">

                                            <label>Images *</label>

                                            <input type="file"
                                                   class="variant_image_input"
                                                   name="variants[{{ $i }}][images][]"
                                                   multiple
                                                   accept="image/*">

                                            <p class="image_count">0 images selected</p>

                                            <div class="image_preview_container"></div>

                                        </div>

                                    </div>
                                </div>

                            @endfor
                        </div>

                        <button class="next_step" type="button" id="add_variant_btn">+ Add variant</button>
                    </div>
                </div>

                <div class="form_buttons">
                    <button type="submit" class="btn_create" >Create Product</button>
                    <button type="button" class="btn_back" onclick="window.location='{{ route('admin.panel') }}'">Back</button>
                </div>

                @if(session('success'))
                    <div class="success_message">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="error_messages">
                        @foreach($errors->all() as $error)
                            <p style="color:red">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('variants_container');
            const addBtn = document.getElementById('add_variant_btn');

            let index = container.querySelectorAll('.variant_row').length;

            addBtn.addEventListener('click', function () {

                const shoeNumber = index + 1;

                const div = document.createElement('div');
                div.classList.add('variant_row');

                div.innerHTML = `
            <div class="variant_header">
                <h3>Shoe ${shoeNumber}</h3>
                <button type="button" class="remove_variant_btn">✕</button>
            </div>

            <div class="variant_body">

                <label>Color *</label>
                <select name="variants[${index}][color_id]">
                    <option value="" disabled selected>
                        -- choose color --
                    </option>

                    @foreach($colors as $cl)
                <option value="{{ $cl->color_id }}">
                            {{ $cl->name }}
                </option>
@endforeach
                </select>

                <label>Size *</label>
                <select name="variants[${index}][size_id]">
                    <option value="" disabled selected>
                        -- choose size --
                    </option>

                    @foreach($sizes as $sz)
                <option value="{{ $sz->size_id }}">
                            {{ $sz->size }}
                </option>
@endforeach
                </select>

                <label>Stock Quantity *</label>
                <input type="number"
                       name="variants[${index}][stock_quantity]"
                       min="0"
                       placeholder="Stock quantity">

                <div class="variant_images">

                    <label>Images *</label>

                    <input type="file"
                           class="variant_image_input"
                           name="variants[${index}][images][]"
                           multiple
                           accept="image/*">

                    <p class="image_count">0 images selected</p>

                    <div class="image_preview_container"></div>

                </div>

            </div>
        `;

                container.appendChild(div);

                index++;
            });

            container.addEventListener('click', function (e) {

                if (e.target.classList.contains('remove_variant_btn')) {

                    e.target.closest('.variant_row').remove();

                    renumberVariants();
                }
            });

            function renumberVariants() {

                const variants = container.querySelectorAll('.variant_row');

                variants.forEach((variant, i) => {

                    variant.querySelector('h3').innerText = `Shoe ${i + 1}`;
                });

                index = variants.length;
            }

        });
    </script>
@endpush
@push('scripts')
    <script>
        document.addEventListener('change', function (e) {

            if (!e.target.classList.contains('variant_image_input')) {
                return;
            }

            const files = e.target.files;

            const variantImages = e.target.closest('.variant_images');

            const previewContainer =
                variantImages.querySelector('.image_preview_container');

            const countText =
                variantImages.querySelector('.image_count');

            previewContainer.innerHTML = '';

            countText.innerText = `${files.length} image(s) selected`;

            if (files.length < 2) {
                countText.style.color = 'red';
                countText.innerText += ' — minimum 2 required';
            } else {
                countText.style.color = 'green';
            }

            Array.from(files).forEach(file => {

                const reader = new FileReader();

                reader.onload = function (event) {

                    const img = document.createElement('img');

                    img.src = event.target.result;

                    img.classList.add('preview_image');

                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
