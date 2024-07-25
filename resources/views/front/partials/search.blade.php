 <!-- Search Start -->
 <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <form action="{{ url('search') }}" method="get">
                <!-- @csrf -->
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" onfocus="this.value=''" placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                            <select name="category_filter" id="category_filter" class="form-select border-0 py-3">
                                <option selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-md-4">
                                <select name="location_filter" id="location_filter" class="form-select border-0 py-3">
                                    <option selected>Pilih Lokasi</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100 py-3">Filter</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- Search End -->

