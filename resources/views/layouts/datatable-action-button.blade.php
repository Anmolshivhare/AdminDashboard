<ul class="data-table-list list-group list-group-horizontal gap-3 justify-content-between">

    @if (!empty($editRoute))
        <li class="data-table-list-item list-group-item border-0 p-0 bg-transparent">
            <a class="edit" href="{{ $editRoute }}">
                <i class="fa fa-edit" style="font-size:24px"></i>
            </a>
        </li>
    @endif

    @if (!empty($viewRoute))
        <li class="data-table-list-item list-group-item border-0 p-0 bg-transparent">
            <a class="edit" href="{{ $viewRoute ? $viewRoute : $editRoute }}">
                <img src="{{ Vite::asset('resources/images/view.svg') }}" alt="view">
            </a>
        </li>
    @endif

  

    @if (!empty($deleteRoute))
        <li class="data-table-list-item list-group-item border-0 p-0 bg-transparent">
            <form action="{{ $deleteRoute }}" method="POST" onsubmit="return confirm('Are you sure?');"
                style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="p-0 border-0 bg-transparent">
                    <i class="fa fa-trash text-danger" style="font-size:24px"></i>
                </button>
            </form>
        </li>
    @endif

  
</ul>
