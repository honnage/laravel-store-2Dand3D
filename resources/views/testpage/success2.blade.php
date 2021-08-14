File list
@foreach ($photos as $photo)
    File Name: {{$photo['fileName']}} <br>
    File Type: {{$photo['fileType']}} <br>
    File Size: {{$photo['fileSize']}} <br>
    <img src="{{asset('images/'.$photo['fileName'])}}" width="120" height="100">
    ------------------------------------------
    <br>
@endforeach