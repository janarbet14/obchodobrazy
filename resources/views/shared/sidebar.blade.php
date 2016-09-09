<h2>Kategórie</h2>
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href='{{url("products")}}'>Všetko</a></h4>
        </div>
        @foreach ($categories as $category)
        <div class="panel-heading">
            <h4 class="panel-title"><a href='{{url("products/categories/$category->id")}}'>{{$category->name}}</a></h4>
        </div>
        @endforeach
    </div>
</div><!--/category-products-->

