@extends('layouts.app')

@section('tab_title')
    {{__('content.search')}}
@endsection

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <h2>{{__('content.start_analyzing')}}</h2>


    <!-- The form -->
    <form class="example" action="{{route('analyzer.post')}}" method="post">
        {{csrf_field()}}
        <input type="text" placeholder="https://www.google.sk" name="url"
               value="{{ old('url') }}">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    @if(isset($result))
        <div class="table-wrapper">
            <div class="headers-wrapper">
                <h3 class="searching-results">{{__('content.searching_results')}}</h3>
                <h3 class="website-name">{{ app('request')->input('url') }}</h3>

            </div>

            <table class="table">

                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('content.module')}}</th>
                    <th scope="col">{{__('content.result')}}</th>
                    <th scope="col">{{__('content.description')}}</th>
                </tr>
                </thead>
                <tbody>

                @include('components.tableItemSupport',
                ['number' => 1, 'module' => __('content.status_code'), 'isSupported' =>
                 $result["statusCode"] == 200,
                 'description' => __('content.status_code_given_site').$result["statusCode"]])

                @include('components.tableItemSupport',
                ['number' => 2, 'module' => __('content.http2_support'), 'isSupported' =>
                 $result["httpTest"]["isSupported"],
                'description' => $result["httpTest"]["isSupported"]?
                 __('content.is_supported'): __('content.is_not_supported') ])

                @include('components.tableItemSupport',
                 ['number' => 3, 'module' => __('content.gzip_support'), 'isSupported' =>
                  $result["gzipTest"]["isSupported"],
                 'description' => $result["gzipTest"]["isSupported"]?
                  __('content.is_supported'): __('content.is_not_supported') ])

                @include('components.tableItemSupport',
                ['number' => 4, 'module' => __('content.webp_support'), 'isSupported' =>
                 $result["webPTest"]["isSupported"],
                'description' => $result["webPTest"]["isSupported"]?
                 __('content.website_use_webp_images'): __('content.website_does_not_use_webp_images') ])

                @include('components.tableItemSupport',
               ['number' => 5, 'module' => __('content.meta_tag_indexing'), 'isSupported' =>
                $result["indexTest"]["metaTag"]["isIndexed"],
               'description' =>  __('content.meta_tag') . " - " . ($result["indexTest"]["metaTag"]["exists"]?
                __('content.exists') : __('content.does_not_exist')) ])

                @include('components.tableItemSupport',
             ['number' => 6, 'module' => __('content.robots_file_indexing'), 'isSupported' =>
              $result["indexTest"]["robotsFile"]["isIndexed"],
             'description' => __('content.robots_txt'). " - " . ($result["indexTest"]["robotsFile"]["exists"]?
              __('content.exists') : __('content.does_not_exist'))  ])

                @include('components.tableItemSupport',
             ['number' => 7, 'module' => __('content.x_robot_tag_indexing'), 'isSupported' =>
              $result["indexTest"]["xRobotTag"]["isIndexed"],
             'description' => __('content.x_robot_tag'). " - " . ($result["indexTest"]["xRobotTag"]["exists"]?
              __('content.exists') : __('content.does_not_exist'))])

                @include('components.tableItemSupport',
            ['number' => 8, 'module' => __('content.missing_alts'), 'isSupported' =>
             $result["imageAltsTest"]["without"] == 0,
            'description' => __('content.without_alt_images'). " - " . $result["imageAltsTest"]["without"] . ", ".
            __('content.with_alt_images'). " - ". $result["imageAltsTest"]["with"]])
                </tbody>
            </table>
        </div>
        <section class="content">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{__('content.title')}}</th>
                                <th>{{__('content.score')}}</th>
                                <th>{{__('content.description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result["insight"]["audits"] as $audit)
                                <tr>
                                    <td>
                                        {{$audit->getTitle()}}
                                    </td>
                                    <td>
                                        {{$audit->getScore()}}
                                    </td>
                                    <td>
                                        {{$audit->getDescription()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{__('content.title')}}</th>
                                <th>{{__('content.score')}}</th>
                                <th>{{__('content.description')}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    @endif
@endsection


