<?php $breadcrumb_array = \App\Http\Controllers\Breadcrumbs::$breadcrumb; ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <?php
            for($i = 0; $i < count($breadcrumb_array); $i++)
            {
                if($i == count($breadcrumb_array)-1)
                { ?>
                    <li>
                        <span>{{ $breadcrumb_array[$i][0] }}</span>
                    </li>
            <?php }
                else
                { ?>
                <li>
                    <a href="{{ route($breadcrumb_array[$i][1]) }}">{{ $breadcrumb_array[$i][0] }}</a>
                    <i class="fa fa-circle"></i>
                </li>
            <?php }
            }
        ?>


    </ul>
</div>

@if(session()->has('success_message'))
    <div style="margin: 5px">
        <div class="alert alert-success" style="border-left: 5px solid #012d31">
            <ul>
                <li>{{ session()->get('success_message') }}</li>
            </ul>
        </div>
    </div>
@endif
@if(session()->has('error_message'))
    <div style="margin: 5px">
        <div class="alert alert-danger" style="border-left: 5px solid #fb0303">
            <ul>
                <li>{{ session()->get('error_message') }}</li>
            </ul>
        </div>
    </div>
@endif