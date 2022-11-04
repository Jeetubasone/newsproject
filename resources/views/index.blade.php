@include('headerf')

<body>
    @include('topbar')


    @include('navbarf')


    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 px-0">
                <div class="owl-carousel main-carousel position-relative">

                    @foreach($query as $key => $q)
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{$q->image}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">{{$q->category_name}}</a>
                                <a class="text-white" href="">{{date('d-M-Y', strtotime($q->created_at))}}</a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{\Illuminate\Support\Str::limit($q->title, 70)}}</a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-lg-5 px-0">
                <div class="row mx-0">
                    @foreach($query as $key => $q)
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="{{$q->image}}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">{{$q->category_name}}</a>
                                    <a class="text-white" href=""><small>{{date('d-M-Y', strtotime($q->created_at))}}</small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{\Illuminate\Support\Str::limit($q->title, 50)}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- Breaking News Start -->
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 170px); padding-right: 90px;">
                            @foreach($query as $key => $q)
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{$q->title}}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


    <!-- Featured News Slider Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Featured News</h4>
            </div>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                @foreach($query as $key => $q)
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid h-100" src="{{$q->image}}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">{{$q->category_name}}</a>
                            <a class="text-white" href=""><small>{{date('d-M-Y', strtotime($q->created_at))}}</small></a>
                        </div>
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{\Illuminate\Support\Str::limit($q->title, 50)}}</a>
                    </div>
                </div>
               
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->


    @include('sidebarf')


    @include('footerf')
</body>

</html>