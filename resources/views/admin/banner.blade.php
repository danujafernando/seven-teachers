@extends('layouts.default')

@section('content')
    <h1 class="page-title">Banners</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <form action="{{ route('banner.post') }}" method="post" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-group">
                            <span class="form-error">
                                <label>Grade <span class="required">*</span></label>
                                <select name="grade" id="grade-banner" class="form-control {{ $errors->has('grade') ? ' is-invalid' : '' }}">
                                    @for($i = 0; $i < count($grades); $i++)
                                    <option value="{{ $grades[$i] }}" @if($grades[$i] == $grade) selected @endif>{{ $grades[$i] }}</option>
                                    @endfor
                                </select>
                            </span>
                            @if ($errors->has('subject'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <?php $image = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"; 
                                $file_class = "fileinput-new";
                                $status = 0;
                                if($banner){
                                    if(file_exists($banner->image_1_url)){
                                        $file_class = "fileinput-exists";
                                        $image = asset($banner->image_1_url);
                                        $status = 1;
                                    }
                                }
                            ?>
                            <div class="fileinput {{ $file_class }}" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;"> 
                                    @if($status)
                                    <img src="{{ $image }}" alt="">
                                    @endif
                                </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="class_image_1">
                                    </span>
                                    @if($status)
                                        <a href="{{ route('banner.remove.post', [$banner->id, 1]) }}"  class="btn default" 
                                            onclick="event.preventDefault(); document.getElementById('banner-remove-{{ $banner->id }}-1').submit();"> Remove </a>
                                    @else
                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a> 
                                    @endif
                                </div>
                            </div>
                            <?php $image = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"; 
                                $file_class = "fileinput-new";
                                $status = 0;
                                if($banner){
                                    if(file_exists($banner->image_2_url)){
                                        $image = asset($banner->image_2_url);
                                        $file_class = "fileinput-exists";
                                        $status = 1;
                                    }
                                }
                                
                            ?>
                            <div class="fileinput {{ $file_class }}" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;"> 
                                    @if($status)
                                        <img src="{{ $image }}" alt="">
                                    @endif
                                </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="class_image_2">
                                    </span>
                                    @if($status)
                                        <a href="{{ route('banner.remove.post', [$banner->id, 2]) }}"  class="btn default" 
                                            onclick="event.preventDefault(); document.getElementById('banner-remove-{{ $banner->id }}-2').submit();"> Remove </a>
                                    @else
                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a> 
                                    @endif
                                </div>
                            </div>
                            <?php $image = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"; 
                                $file_class = "fileinput-new";
                                $status = 0;
                                if($banner){
                                    if(file_exists($banner->image_3_url)){
                                        $image = asset($banner->image_3_url);
                                        $file_class = "fileinput-exists";
                                        $status = 1;
                                    }
                                }
                                
                            ?>
                            <div class="fileinput {{ $file_class }}" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;"> 
                                    @if($status)
                                        <img src="{{ $image }}" alt="">
                                    @endif
                                </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="class_image_3">
                                    </span>
                                    @if($status)
                                        <a href="{{ route('banner.remove.post', [$banner->id, 3]) }}"  class="btn default" 
                                            onclick="event.preventDefault(); document.getElementById('banner-remove-{{ $banner->id }}-3').submit();"> Remove </a>
                                    @else
                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Submit</button>
                    </div>
                    </form>
                    @if($banner)
                        @if(file_exists($banner->image_1_url))
                            <form id="banner-remove-{{ $banner->id }}-1" action="{{ route('banner.remove.post', [$banner->id, 1]) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        @if(file_exists($banner->image_2_url))
                            <form id="banner-remove-{{ $banner->id }}-2" action="{{ route('banner.remove.post', [$banner->id, 2]) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        @if(file_exists($banner->image_3_url))
                            <form id="banner-remove-{{ $banner->id }}-3" action="{{ route('banner.remove.post', [$banner->id, 3]) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        var url = "{{ route('banner.get') }}";
        $('#grade-banner').on('change', function(){
            var grade = $(this).val(); 
            window.location.href = url + "/" + grade;
        });
    });
</script>    
@endsection