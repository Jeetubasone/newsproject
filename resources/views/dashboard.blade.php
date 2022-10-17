@include('header')


        <!-- Content Start -->
        <div class="content">
        @include('navbar')


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-2">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total News</p>
                                <h6 class="mb-0">{{$totalnews}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Advertisement</p>
                                <h6 class="mb-0">{{$totalads}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Category Wise News</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Total News</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $key => $d)
                                <tr>
                                    <td>{{$details[$key]['id']}}</td>
                                    <td>{{$details[$key]['name']}}</td>
                                    <td>{{$details[$key]['total']}}</td>
                                </tr>
                               
                           
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Newslatters Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Newslatters</h6>
                        <a href=""></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Id</th>
                                    <th scope="col">Email</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newslatters as $key => $d)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$newslatters[$key]['email']}}</td>
                                   
                                </tr>
                               
                           
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Newslatters End -->


            @include('footer')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('jslibrary')
</body>

</html>