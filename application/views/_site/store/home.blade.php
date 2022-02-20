@extends('_templates.site')

@section('site_content')

<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>

        <div class="row">
          @foreach ( $product as $data )
            <div class='col-sm-6 col-md-4'>
                <div class='img-produto-home' style="background-image: url('{{ base_url('upload/produtoimagem/') }}/@if ( isset ($data['image_info']['p_image_image']) && $data['image_info']['p_image_image'] != null && !empty($data['image_info']) ) {{ $data['image_info']['p_image_image'] }} @else sem_imagem.png @endif');"></div>
                <div class=''>
                    <h2>{{ $data['product_name'] }}</h2>
                    <p> {!! $data['product_description'] !!} </p>
                    <h5>{{ $data['category_name'] }} >> {{ $data['subcategory_name'] }} </h5>
                    <p><a class='btn btn-primary' href="{{ base_url('store/productPage/'.$data['id_product']) }}" role='button'> Saiba mais </a></p>
                </div>
            </div>
          @endforeach

        </div><!--/row-->
    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <?php echo showCategory(); ?>
        </div>
    </div><!--/.sidebar-offcanvas-->

</div>
@endsection
