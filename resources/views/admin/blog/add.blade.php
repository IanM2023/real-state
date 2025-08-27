@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/blog') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
        </ol>
    </nav>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Blog</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/blog/add') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Title <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" placeholder="Enter Title Name" required>
                            <span style="color: red;">{{ $errors->first('title') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Slug <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="slug" class="form-control" placeholder="Enter Slug Name" required>
                            <span style="color: red;">{{ $errors->first('slug') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control editor" name="description" placeholder="Enter Description" ></textarea>
                            <span style="color: red;">{{ $errors->first('description') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/blog') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        	  tinymce.init({
                selector: '.editor', // your textarea selector
                height:'500px',
                plugins: 'link code image textcolor codesample',
                codesameple_language: [
                    {text: 'HTML/XML', value: 'markup'},
                    {text: 'JavaScript', value: 'javascript'},
                    {text: 'CSS', value: 'css'},
                    {text: 'PHP', value: 'php'},
                    {text: 'Ruby', value: 'ruby'},
                    {text: 'Python', value: 'python'},
                    {text: 'Java', value: 'java'},
                    {text: 'C', value: 'c'},
                    {text: 'C#', value: 'csharp'},
                    {text: 'C++', value: 'cpp'}
                ],
                toolbar: [
                    "fontselect | bullist numlist outdent indent | undo redo | fontsizeselect | styleselect | bold italic | link image",
                    "codesample",
                    "alignleft aligncenter alignright Justify | forecolor backcolor",
                    "fullscreen"
                ],
                fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
                font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutikndPadmini=AKpdmi-n',
                content_style: 'body { color: white;}',
            });
    </script>
@endsection