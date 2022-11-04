<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href=""></a>
                        </div>
                    </div>
                    @foreach($query as $key => $q)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">

                            <img class="img-fluid w-100" src="{{$q->image}}" style="object-fit: cover;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">{{$q->category_name}}</a>
                                    <a class="text-body" href=""><small>{{date('d-M-Y', strtotime($q->created_at))}}</small></a>
                                </div>
                                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{\Illuminate\Support\Str::limit($q->title, 50)}}</a>
                                <p class="m-0">{{\Illuminate\Support\Str::limit($q->content, 200)}}</p>
                                <div class="d-flex justify-content-end">
                                <a class="btn btn-primary btn-sm " href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}} role="button">Read More</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12 mb-3">
                        <a href=""><img class="img-fluid w-100" src="img/ads-728x90.png" alt=""></a>
                    </div>
                    @foreach($query as $key => $q)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{$q->image}}" style="object-fit: cover;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">{{$q->category_name}}</a>
                                    <a class="text-body" href=""><small>{{date('d-M-Y', strtotime($q->created_at))}}</small></a>
                                </div>
                                <a class="h4 d-block mb-0 text-secondary text-uppercase font-weight-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{\Illuminate\Support\Str::limit($q->title, 50)}}</a>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-4">
                <!-- Social Follow Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Follow Us</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-3">
                        <a href="https://www.facebook.com/indiatvnews/" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #39569E;">
                            <i class="fab fa-facebook-f text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                            <span class="font-weight-medium">12,345 Fans</span>
                        </a>
                        <a href="https://twitter.com/timesnow" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #52AAF4;">
                            <i class="fab fa-twitter text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                            <span class="font-weight-medium">12,345 Followers</span>
                        </a>
                        <a href="https://in.linkedin.com/company/republic-world?trk=similar-pages" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #0185AE;">
                            <i class="fab fa-linkedin-in text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                            <span class="font-weight-medium">12,345 Connects</span>
                        </a>
                        <a href="https://www.instagram.com/bbcnews/" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #C8359D;">
                            <i class="fab fa-instagram text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                            <span class="font-weight-medium">12,345 Followers</span>
                        </a>
                        <a href="https://www.youtube.com/channel/UCYfdidRxbB8Qhf0Nx7ioOYw" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #DC472E;">
                            <i class="fab fa-youtube text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                            <span class="font-weight-medium">12,345 Subscribers</span>
                        </a>
                        
                    </div>
                </div>
                <!-- Social Follow End -->

                <!-- Ads Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Advertisement</h4>
                    </div>
                    @foreach($ads as $key => $a)
                    <div class="bg-white text-center border border-top-0 p-3">
                        <a href=""><img class="img-fluid" src="{{$a->add_image}}" alt=""></a>
                    </div>
                    @endforeach
                </div>
                <!-- Ads End -->

                <!-- Popular News Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Tranding News</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-3">
                        @foreach($query as $key => $q)
                        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                            <img class="img-fluid" src="img/news-110x110-1.jpg" alt="">
                            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$q->category_name}}</a>
                                    <a class="text-body" href=""><small>{{date('d-M-Y', strtotime($q->created_at))}}</small></a>
                                </div>
                                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="{{ url('/singlenews', $q->id) }}" id="id" name="id" value={{$q->id}}">{{\Illuminate\Support\Str::limit($q->title, 50)}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Popular News End -->

                <!-- Newsletter Start -->
                <form action="/newslatters" method="post">
                    @csrf
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Newsletter</h4>
                    </div>
                    <div class="bg-white text-center border border-top-0 p-3">
                        <p>Aliqu justo et labore at eirmod justo sea erat diam dolor diam vero kasd</p>
                        <div class="input-group mb-2" style="width: 100%;">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Your Email">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary font-weight-bold px-3">Sign Up</button>
                            </div>
                        </div>
                        <small>Lorem ipsum dolor sit amet elit</small>
                    </div>
                </div>
                </form>
                <!-- Newsletter End -->

                <!-- Tags Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-3">
                        <div class="d-flex flex-wrap m-n1">

                            @foreach($query1 as $key => $q)
                            <a href="{{ url('/categorynews', $q->category_id) }}" class="btn btn-sm btn-outline-secondary m-1" id="category_id" name="category_id" value={{$q->id}}>{{$q->category_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Tags End -->
            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->