<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    @for($i = 1; $i <= count(Request::segments()); $i++)
                    <li class="breadcrumb-item active"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
                    @endfor
                </ol>
            </div>
        </div>
    </div>
</div>