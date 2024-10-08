<aside class="main-sidebar sidebar-dark-primary ">

    <a href="{{ route('site-data-collection.index') }}" class="brand-link">
        <img src="{{ asset('assets/web-images/main-logo-sm.png') }}" alt="AdminLTE Logo" class="brand-image "
            style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 19px !important"><b>DALCO JOHOR (AERO)</b></span>
    </a>


    <div class="sidebar">

        <div class="user-panel mt-2 pb-2 mb-2 d-flex">

            <div class="info text-center">
                <a href="#" class=" text-center ml-4">Nav links</a>
            </div>
        </div>



        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->type === true)
                    <ul>
                        <li
                            class="nav-item">
                            <a href="{{ route('site-data-collection.index') }}" class="nav-link">
                                <i class="fa fa-book"></i>
                                <p>
                                    Add Budget
                                </p>
                            </a>
                        </li>
                    </ul>

                  
                @endif
                <!-- <li
                    class="nav-item {{ Request::route()->getName() === 'order.create' || Request::route()->getName() === 'admin-order.index' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class=" fas fa-cart-plus"></i>
                        <p>
                            Requisition
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @if (Auth::user()->type === false)
                            <li class="nav-item">
                                <a href="{{ route('order.create') }}"
                                    class="nav-link {{ Request::route()->getName() === 'order.create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Make Order</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('admin-order.index') }}"
                                class="nav-link {{ Request::route()->getName() === 'admin-order.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/complete-orders"
                                class="nav-link {{ Request::route()->getName() === 'order.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complete Orders</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/cancel-orders"
                                class="nav-link {{ Request::route()->getName() === 'order.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cancel Orders</p>
                            </a>
                        </li>
                    </ul>


                </li> -->




                @if (Auth::user()->type === true)
                    <!-- <ul>
                        <li class="nav-item">
                            <a href="{{ route('requisition.index') }}"
                                class="nav-link {{ Request::route()->getName() === 'requisition.index' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Stock Management</p>
                            </a>
                        </li>
                    </ul>

                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('scrap.index') }}"
                                class="nav-link {{ Request::route()->getName() === 'scrap.index' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-anchor"></i>
                                <p>Scrap</p>
                            </a>
                        </li>
                    </ul>
 -->


                <ul>
                    <li class="nav-item">
                        <a href="{{ route('rmu-budget-tnb.budgets') }}"
                            class="nav-link  ">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Add Payment-PE </p>
                        </a>
                    </li>
                </ul>

                <ul>
                    <li class="nav-item">
                        <a href="{{ route('payment-summary-details.index') }}"
                            class="nav-link  ">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Add Payments-Project</p>
                        </a>
                    </li>
                </ul>

             

                <ul>
                    <li class="nav-item">
                        <a href="{{ route('paymentviewdetail.Paymentview') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Pending Payments</p>
                        </a>
                    </li>
                </ul>
                

                <ul>
                    <li class="nav-item">
                        <a href=""
                            class="nav-link  ">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Summary</p>
                        </a>
                    </li>
                </ul>


                @endif

            </ul>
        </nav>



    </div>

</aside>
<style>
    .nav-link p {
        color: #818896 !important;
    }

    .nav-item p:hover,
    .nav-item i:hover,
    nav .active i,
    nav .active p {
        color: #16c7ff !important;
    }

    nav .active {
        background-color: rgb(99 99 99 / 46%) !important;
    }
</style>
