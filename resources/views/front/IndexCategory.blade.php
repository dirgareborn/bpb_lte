
        <!-- Category Start -->
        <div class="container-xxl py-12">
            <div class="container">
                <div class="text-center mx-auto mb-8 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 1200px;">
                    <h1 class="mb-12">Badan Pengambangan Bisnis Universitas Negeri Makassar</h1>
                    <p>Badan Pengambangan Bisnis (BPB) Badan Layanan Umum Universitas Negeri Makassar
                    (BLU UNM) merupakan badan yang secara khsusus melakukan kegiatan bisnis dan
                    transasksi keuangan non akademik mulai dari menciptakan, pengelolaan dan
                    pengembangan bisnis dalam ruang lingkup BLU UNM Makassar serta kerjasama dengan
                    berbagai pihak, baik di dalam maupun luar negeri.
                    BPB BLU UNM senantiasa mengedepankan kreatifitas, inovasi, professional dan
                    transparansi dalam rangka mewujudkan BLU UNM yang mandiri, berdaya saing global
                    dan penuh manfaat untuk civitas dan masyarakat sekitar. .</p>
                </div>
                <div class="row g-4">
                @if( $categories->count() )
                    @foreach($categories as $category)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="{{ url('kategori', $category->url) }}">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <!-- add icon field -->
                                    <img class="img-fluid" src="front/images/categories/{{$category->category_image }}" alt="Icon">
                                </div>
                                <h6>{{ $category->category_name}}</h6>
                                <span>{{ $category->products->count()}}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
            </div>
        </div>
        <!-- Category End -->
