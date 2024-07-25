@extends('front.layouts.app')
@section('content')
<!-- Header Start -->
<div class="container-fluid header bg-white p-0" >
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <div class="col-md-6 p-5 mt-lg-5">
            <h1 class="display-5 animated fadeIn mb-4">{{$page_title}}</h1>
            <nav aria-label="breadcrumb animated fadeIn">
                <ol class="breadcrumb text-uppercase">
                    @for($i = 1; $i <= count(Request::segments()); $i++) <li class="breadcrumb-item"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
                        @endfor
                </ol>
            </nav>
        </div>
        <div class="col-md-6 animated fadeIn">
            <img class="img-fluid" src="{{ asset('front/img/header.jpg') }}" alt="">
        </div>
    </div>
</div>
<!-- Header End -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                <h1 class="mb-3"></h1>
            </div>
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                </div>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                @if(isset($visimisi))
                <h3 class="text-primary mb-3">VISI</h3>
                <p>{!! $visimisi->visi !!}</p>


                <h3 class="text-primary mb-3">MISI</h3>
                <p>{!! $visimisi->misi !!}</p>

                @else
                <h4 class="text-center"><span class="fa fa-times"></span> Data tidak ditemukan.</h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection