<table id="recent-orders" class="table table-hover table-xl mb-0">
    <thead>
        <tr>

            
            <th class="border-top-0">Menu Name</th>
            <th class="border-top-0">Sub Functions</th>

        </tr>
    </thead>
    <tbody>
        @if($menu_list)
  
        @foreach($menu_list as $menu)
        <tr>
            @if($menu->menu_type==1)
           

            <td>
                {{$menu->menu_name}} - {{$menu->description}}
                <a onclick="update_parent('{{$menu->id}}')" class="success p-0" data-original-title="" title="">
                    <input id="tpname{{$menu->id}}" type="hidden" value="{{$menu->menu_name}}">
                    <input id="tpurl{{$menu->id}}" type="hidden" value="{{$menu->url}}">
                    <input id="tpdesc{{$menu->id}}" type="hidden" value="{{$menu->description}}">

                <i class="fa fa-pencil font-medium-3 mr-2"></i>
                </a>
            </td>
            <td>
                @if($menu->sub_functions!='')
                @foreach($menu->sub_functions as $menu_sub)
                @if($menu_sub->menu_type==2)
                <br>
                <br>
                <span class="badge badge-info">Sub Menu</span> {{$menu_sub->menu_name}} - {{$menu_sub->description}}
                @endif
                @if( $menu_sub->menu_type==3)
                <br>
                <br>
                <span class="badge badge-warning">Sub Function</span> {{$menu_sub->menu_name}} - {{$menu_sub->description}}

                <a onclick="delete_sub_function({{$menu_sub->id}})" class="danger p-0" data-original-title="" title="">
                    <i class="ft-trash-2 font-medium-3 mr-2"></i>
                </a>
                @endif

                <a onclick="update( '{{$menu_sub->id}}','{{$menu->id}}','{{$menu_sub->menu_type}}')" class="success p-0" data-original-title="" title="">
                    <i class="fa fa-pencil font-medium-3 mr-2"></i>
                    <input id="tsname{{$menu_sub->id}}" type="hidden" value="{{$menu_sub->menu_name}}">
                    <input id="tsurl{{$menu_sub->id}}" type="hidden" value="{{$menu_sub->url}}">
                    <input id="tsdesc{{$menu_sub->id}}" type="hidden" value="{{$menu_sub->description}}">
                </a>
                @if($menu_sub->active_status==1)
                <a onclick="status_change( {{$menu_sub->id}},0)" class="danger p-0" data-original-title="" title="">
                    <i class="fa fa-times font-medium-3 mr-2"></i>
                </a>
                @else
                <a onclick="status_change({{$menu_sub->id}},1)" class="info p-0" data-original-title="" title="">
                    <i class="fa fa-check font-medium-3 mr-2"></i>
                </a>
                @endif
                @endforeach
                @endif

            </td>

            @endif


        </tr>
        @endforeach
        @else
        @endif
    </tbody>
</table>
<div class="pagi">
    {{$menu_list->links('pagination::bootstrap-4')}}
</div>