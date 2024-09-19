<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="#">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">#</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">home </li>


        <!-- الابناء-->
        <li>
            <a href="{{ route('tasks.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">tasks</span></a>
        </li>

        <!-- تقرير الحضور والغياب-->
        <li>
            <a href="#"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">تقرير الحضور والغياب</span></a>
        </li>

        <!-- تقرير المالية-->
        <li>
            <a href="#"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">تقرير المالية</span></a>
        </li>


        <!-- Settings-->
        <li>
           <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn">logout</button>
           </form>
        </li>

    </ul>
</div>
