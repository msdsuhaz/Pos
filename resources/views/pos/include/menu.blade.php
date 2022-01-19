@php
$prefix = Request::route()->getPrefix();
$route =Route::current()->getName();
@endphp
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           @if(Auth::user()->usertype=="Admin")
            <li class="nav-item has-treeview  {{($prefix=='/user')?'menu-open':''}}">
              <a href="#" class="nav-link">
                <i class="fa fa-user-md nav-icon "></i>
                <p>
                  Manage User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{route('user.view')}}" class="nav-link {{($route=='user.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>view user</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
        
      <li class="nav-item has-treeview  {{($prefix=='/profile')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa-male nav-icon"></i>
          <p>
            Manage Profile
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
           <a href="{{route('profile.view')}}" class="nav-link {{($route=='profile.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Your Profile</p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('password.view')}}" class="nav-link {{($route=='password.view')?'active':''}}">
               <i class="far fa-circle nav-icon"></i>
               <p>Change password</p>
             </a>
           </li>
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/supplier')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa-plane"></i>
          <p>
            Manage Supplier
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('supplier.view')}}" class="nav-link  {{($route=='supplier.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view supplier</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/customer')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa-handshake"></i>
          <p>
            Manage Customer
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('customer.view')}}" class="nav-link  {{($route=='customer.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view customer</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/unit')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa fa-circle"></i>
          <p>
            Manage Unit
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('unit.view')}}" class="nav-link  {{($route=='unit.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view unit</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview  {{($prefix=='/category')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa  fa-calendar"></i>
          <p>
            Manage Category
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('category.view')}}" class="nav-link  {{($route=='category.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view Category</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/product')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa  fa-calendar"></i>
          <p>
            Manage Product
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('product.view')}}" class="nav-link  {{($route=='product.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view Product</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/purchase')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa  fa-calendar"></i>
          <p>
            Manage Purchase
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('purchase.view')}}" class="nav-link  {{($route=='purchase.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view Purchase</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('purchase.approved.list')}}" class="nav-link  {{($route=='purchase.approved.list')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Approved Purchase</p>
              </a>
            </li>
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/purchase')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa  fa-calendar"></i>
          <p>
            Manage Invoice
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('invoice.view')}}" class="nav-link  {{($route=='invoice.view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>view Invoice</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('invoice.approved.list')}}" class="nav-link  {{($route=='invoice.approved.list')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Approved Invoice</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('invoice.print.list')}}" class="nav-link  {{($route=='invoice.print.list')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Invoice</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{route('invoice.dailyreport')}}" class="nav-link  {{($route=='invoice.dailyreport')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daily Invoice</p>
                  </a>
              </li>  
        </ul>
      </li>
      <li class="nav-item has-treeview  {{($prefix=='/stock')?'menu-open':''}}">
        <a href="#" class="nav-link">
          <i class="fa fa  fa-calendar"></i>
          <p>
            Manage Stock
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('stock.report')}}" class="nav-link  {{($route=='stock.report')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Stock Report</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('supplier-product-wise-stock')}}" class="nav-link  {{($route=='supplier-product-wise-stock')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>supplier/product wise stock</p>
              </a>
            </li>
       
        </ul>
      </li>
    
      </li>
      
    </ul>
  </nav>