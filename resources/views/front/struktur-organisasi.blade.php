@extends('front.layouts.app')
@section('content')
 <!-- Header Start -->
 <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">{{$page_title}}</h1> 
                        <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
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
        @include('front.partials.search')
        <div class="container-xxl py-5">
            <div class="container">
                        <div class="row g-0 text-center">
                        <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                            @if(isset($strukturorganisasi))
                            <img class="img-fluid" src="{{ asset('images/')}}/{{ $strukturorganisasi->file_struktur_organisasi }}" alt="" >
                            @else
                            <h4 class="text-center"><span class="fa fa-times"></span> Data tidak ditemukan.</h4>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
@endsection
       