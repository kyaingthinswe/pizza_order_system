<!-- Shop Sidebar Start -->
<div class="col-lg-3 col-md-4 ">
    <!-- Category Start -->
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span></h5>
    <div class="bg-light p-4 mb-30">
        <div class=" shadow-sm categoryBox mb-3 border-left  border-primary">
            <a href="{{route('user_home')}}" class="text-decoration-none text-dark categoryText">
                <label class="m-0 p-2" for="price-all">All Pizza</label>
            </a>
        </div>
        @foreach($categories as $c)
        <div class=" shadow-sm  mb-3 categoryBox  border-left  border-primary">
            <a href="{{route('user_filterCategory',$c->id)}}" class="text-decoration-none text-dark categoryText">
                <label class="m-0 p-2" for="price-all">{{$c->name}}</label>
            </a>
        </div>

        @endforeach
    </div>
    <!-- Category End -->

</div>
<!-- Shop Sidebar End -->



