

@include('frontend.layouts.head')
@include('frontend.layouts.header')

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">{!! lang()=='ar'?setting()->msg_maintenance_ar:setting()->msg_maintenance_en !!}</h2>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

@include('frontend.layouts.footer')
@include('frontend.layouts.closeHtml')

