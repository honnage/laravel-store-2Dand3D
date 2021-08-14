
<h1>single upload</h1>
<form action="{{url('test/upload/test/single-upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="form-group my-4">
        <strong class="col-sm-12">รูปภาพ :<strong style="color:red;"> * </strong></strong><br>
        <input type="file" name="photo" class="form-control">
    </div>
    <br>
    <div class="d-flex flex-row-reverse bd-highlight">
        <button type="submit" name="upload" class="btn btn-success col-sm-2">เพิ่มข้อมูล</button>
    </div>
</form>


<h1>multiple upload</h1>
<form action="{{url('test/upload/test/multiple-upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="form-group my-4">
        <strong class="col-sm-12">รูปภาพ :<strong style="color:red;"> * </strong></strong><br>
        <input type="file" name="photos[]" class="form-control" multiple="multiple">
    </div>
    <br>
    <div class="d-flex flex-row-reverse bd-highlight">
        <button type="submit" name="upload" class="btn btn-success col-sm-2">เพิ่มข้อมูล</button>
    </div>
</form>


<input type="file" id="file-selector" multiple>
<script>
  const fileSelector = document.getElementById('file-selector');
  fileSelector.addEventListener('change', (event) => {
    const fileList = event.target.files;
    console.log(fileList);
  });
</script>