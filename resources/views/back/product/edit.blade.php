@extends('layouts.admin')
@section('content')
<div class="title-section">
    <div class="title">Edit Product</div>
</div>
<div class="product-create-section">
    <form class="form-create-product" action="{{route('admin.product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT');
        <input type="text" placeholder="title" name="title" class="create-form-input" value="{{$product->title}}">
        <input type="text" placeholder="price" name="price" class="create-form-input" value="{{$product->price}}">
        <input type="text" placeholder="color" name="color" class="create-form-input" value="{{$product->color}}">
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
            });
        </script>
        <textarea name="description" >
            {{$product->description}}
        </textarea>
        <input type="file" name="image">
        <button class="button-create-product" type="submit">Submit</button>
    </form>
</div>

@endsection