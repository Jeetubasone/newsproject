@include('header')

        <!-- Content Start -->
        <div class="content">
           @include('navbar')
        <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-6">App Setting Form</h6>
                            <form action="" method="post" >
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="site_name" name="site_name" class="form-group col-md-6">Site Name</label>
                                    <input type="text" class="form-control" id="site_name"  name="site_name" value="{{$data->site_name}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="site_logo" class="form-label">Site Logo</label>
                                    <input type="file" class="form-control" id="site_logo" name="site_logo" value="{{$data->site_logo}}">
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{$data->facebook}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="twitter"  class="form-label">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{$data->twitter}}">
                                </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <label for="linkedin" class="form-label">Linkedin</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{$data->linkedin}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{$data->youtube}}">
                                </div>
                                </div>
                                <div class="mb-3">
                                    <label for="about_us" class="form-label">About us</label>
                                    <input type="text" class="form-control" id="about_us" name="about_us" value="{{$data->about_us}}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}">
                                </div>
                                <div class="d-flex justify-content-end"><button type="submit" class="btn btn-info">Update</button></div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        <!-- Form End -->
            @include('footer')
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('jslibrary')
</body>

</html>