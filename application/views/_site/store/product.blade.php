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
              @for ($i = 0; $i < sizeof($data['image_info']); $i++)
                  @if ($i == 0)
                    <div class='col-sm-12 col-md-12'>
                        <a data-fancybox='gallery' data-caption='<h3>{{ $data['image_info'][$i]['p_image_name'] }}</h3>{!! $data['image_info'][$i]['p_image_description'] !!}' href="{{ base_url('upload/produtoimagem/'.$data['image_info'][$i]['p_image_image']) }}">
                            <img class='img-fluid' src="{{ base_url('upload/produtoimagem/'.$data['image_info'][$i]['p_image_image']) }}">
                        </a>
                    </div>
                  @else
                    <div class='col-sm-3 col-md-3 margin-top-10 '>
                        <a data-fancybox='gallery' data-caption='<h3>{{ $data['image_info'][$i]['p_image_name'] }}</h3> {!! $data['image_info'][$i]['p_image_description'] !!}'  href="{{ base_url('upload/produtoimagem/'.$data['image_info'][$i]['p_image_image']) }}">
                          <img class='img-fluid' src="{{ base_url('upload/produtoimagem/'.$data['image_info'][$i]['p_image_image']) }}">
                        </a>
                    </div>
                  @endif
              @endfor

              <div class='col-sm-12 col-md-12 margin-top-10'>
                  <div class='card'>
                      <h2 class='card-header'>{$data['product_name']}</h2>
                      <div class='card-body'>
                      <p class='card-text'> {$data['product_description']} </p>

                      @if ( $data['product_width'] != 0 )
                        <p class='card-text'> <b>Largura:</b> {$data['product_weight']} </p>
                      @endif

                      @if ( $data['product_height'] != 0 )
                        <p class='card-text'> <b>Altura:</b> {$data['product_height']} </p>
                      @endif

                      @if ( $data['product_depth'] != 0 )
                        <p class='card-text'> <b>Profundidade:</b> {$data['product_depth']} </p>
                      @endif

                      @if ( $data['product_weight'] != 0 )
                          <p class='card-text'> <b>Peso: (Kilos)</b> {$data['product_weight']} </p>
                      @endif

                      @if ( $data['product_price'] != 0 )
                          @if ( $data['product_promotion_price'] != 0 )
                              <p class='card-text'> <b>Preço: </b> de <s>R$ ".number_format($data['product_price'],2,',','.')."</s> por R$ ".number_format($data['product_promotion_price'],2,',','.')." </p>
                          @else
                              <p class='card-text'> <b>Preço: </b> R$ ".number_format($data['product_price'],2,',','.')." </p>
                          @endif
                      @endif

                          <h6 class='card-text'> {$data['category_name']} >> {$data['subcategory_name']} </h6>
                          </div>
                          <div class='card-footer'>
                          <button type='button' class='btn btn-success'> Comprar </button>
                      </div>
                  </div>
              </div>
            @endforeach

            @if(isset($item_info))

              @define $classification_name = "";

              <div class='col-sm-12 col-md-12 margin-top-10'>
                  <div class='card'>
                      <h2 class='card-header'> Especificações </h2>
                      <div class='card-body'>
                          <div class='row'>
                            @for ( $i = 0; $i < sizeof($item_info); $i++)
                              @if ( $classification_name != $item_info[$i]['c_item_name'])
                                </ul> <ul class='col-sm-6 col-md-6 margin-top-10 list-wyvern'> <li class='list-wyvern-item'> <h5>{$item_info[$i]['c_item_name']}</h5> </li>";
                                @define $classification_name = $item_info[$i]['c_item_name'];
                              @endif

                              <li class='list-wyvern-item'> <p> {$item_info[$i]['item_name']} </p> </li>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div><!--/row-->
    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <?php echo showCategory(); ?>
        </div>
    </div><!--/.sidebar-offcanvas-->

</div>
@endsection
