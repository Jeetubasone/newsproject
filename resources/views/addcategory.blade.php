@include('header')

        <!-- Content Start -->
        <div class="content">
        @include('navbar')


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Category</h6>
                            <form action="/add" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label" >Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="description" >Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add</button>
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